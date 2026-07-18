<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class CommodityCategory extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
    ];

    public function commodities(): HasMany
    {
        return $this->hasMany(Commodity::class, 'category_id');
    }
}