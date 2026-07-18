<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class WeatherCache extends Model
{
    protected $table = 'weather_cache';

    public $timestamps = false;

    protected $fillable = [
        'market_id',
        'temperature',
        'rainfall',
        'wind_speed',
        'humidity',
        'weather_code',
        'retrieved_at',
    ];

    protected function casts(): array
    {
        return [
            'temperature' => 'decimal:2',
            'rainfall' => 'decimal:2',
            'wind_speed' => 'decimal:2',
            'humidity' => 'decimal:2',
            'retrieved_at' => 'datetime',
        ];
    }

    public function market(): BelongsTo
    {
        return $this->belongsTo(Market::class);
    }
}