<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PriceHistory extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'price_id',
        'old_price',
        'new_price',
        'changed_by',
        'changed_at',
    ];

    protected function casts(): array
    {
        return [
            'old_price' => 'decimal:2',
            'new_price' => 'decimal:2',
            'changed_at' => 'datetime',
        ];
    }

    public function price(): BelongsTo
    {
        return $this->belongsTo(Price::class);
    }

    public function changedBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'changed_by');
    }
}