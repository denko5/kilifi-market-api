<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PriceResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'price' => $this->price,
            'currency' => $this->currency,
            'price_date' => $this->price_date?->format('Y-m-d'),
            'remarks' => $this->remarks,
            'market' => new MarketResource($this->whenLoaded('market')),
            'commodity' => new CommodityResource($this->whenLoaded('commodity')),
            'updated_by' => $this->whenLoaded('updatedBy', fn () => $this->updatedBy?->name),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}