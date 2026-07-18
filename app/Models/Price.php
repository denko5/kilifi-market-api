<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Price extends Model
{
    use HasFactory;

    protected $fillable = [
        'market_id',
        'commodity_id',
        'price',
        'currency',
        'price_date',
        'updated_by',
        'remarks',
    ];

    protected function casts(): array
    {
        return [
            'price' => 'decimal:2',
            'price_date' => 'date',
        ];
    }

    public function market(): BelongsTo
    {
        return $this->belongsTo(Market::class);
    }

    public function commodity(): BelongsTo
    {
        return $this->belongsTo(Commodity::class);
    }

    public function updatedBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'updated_by');
    }

    public function histories(): HasMany
    {
        return $this->hasMany(PriceHistory::class);
    }
}