<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Traits\ApiResponse;
use App\Models\Market;
use App\Services\WeatherService;
use Illuminate\Http\Request;

class WeatherController extends Controller
{
    use ApiResponse;

    public function __construct(protected WeatherService $weatherService)
    {
    }

    public function index(Request $request)
    {
        $request->validate([
            'market_id' => ['required', 'integer', 'exists:markets,id'],
        ]);

        $market = Market::findOrFail($request->market_id);

        $weather = $this->weatherService->getForMarket($market);

        if (! $weather) {
            return $this->error('Weather data is currently unavailable for this market.', null, 503);
        }

        return $this->success('Weather retrieved successfully.', [
            'temperature' => $weather->temperature,
            'humidity' => $weather->humidity,
            'rain_probability' => $weather->rainfall,
            'wind_speed' => $weather->wind_speed,
        ]);
    }
}