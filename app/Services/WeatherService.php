<?php

namespace App\Services;

use App\Models\Market;
use App\Models\WeatherCache;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class WeatherService
{
    protected int $cacheMinutes = 30;

    public function getForMarket(Market $market): ?WeatherCache
    {
        $cached = WeatherCache::where('market_id', $market->id)
            ->where('retrieved_at', '>=', now()->subMinutes($this->cacheMinutes))
            ->latest('retrieved_at')
            ->first();

        if ($cached) {
            return $cached;
        }

        return $this->fetchAndStore($market);
    }

    protected function fetchAndStore(Market $market): ?WeatherCache
    {
        if (! $market->latitude || ! $market->longitude) {
            return null;
        }

        $response = Http::timeout(10)->get('https://api.open-meteo.com/v1/forecast', [
            'latitude' => $market->latitude,
            'longitude' => $market->longitude,
            'current' => 'temperature_2m,relative_humidity_2m,wind_speed_10m,precipitation_probability',
        ]);

        if (! $response->successful()) {
            Log::error('Open-Meteo request failed', [
                'market_id' => $market->id,
                'status' => $response->status(),
            ]);

            return null;
        }

        $current = $response->json('current');

        return WeatherCache::create([
            'market_id' => $market->id,
            'temperature' => $current['temperature_2m'] ?? null,
            'rainfall' => $current['precipitation_probability'] ?? null,
            'wind_speed' => $current['wind_speed_10m'] ?? null,
            'humidity' => $current['relative_humidity_2m'] ?? null,
            'weather_code' => null,
            'retrieved_at' => now(),
        ]);
    }
}