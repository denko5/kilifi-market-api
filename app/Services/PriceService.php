<?php

namespace App\Services;

use App\Models\Price;
use App\Models\PriceHistory;
use Illuminate\Support\Facades\Auth;

class PriceService
{
    public function create(array $data): Price
    {
        $data['updated_by'] = Auth::id();

        return Price::create($data);
    }

    public function update(Price $price, array $data): Price
    {
        $oldPrice = $price->price;

        $price->update(array_merge($data, ['updated_by' => Auth::id()]));

        if (isset($data['price']) && (float) $data['price'] !== (float) $oldPrice) {
            PriceHistory::create([
                'price_id' => $price->id,
                'old_price' => $oldPrice,
                'new_price' => $data['price'],
                'changed_by' => Auth::id(),
                'changed_at' => now(),
            ]);
        }

        return $price->fresh();
    }
}