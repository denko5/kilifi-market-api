<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Price\StorePriceRequest;
use App\Http\Requests\Price\UpdatePriceRequest;
use App\Http\Resources\PriceResource;
use App\Http\Traits\ApiResponse;
use App\Models\Commodity;
use App\Models\Price;
use App\Services\PriceService;
use Illuminate\Http\Request;

class PriceController extends Controller
{
    use ApiResponse;

    public function __construct(protected PriceService $priceService)
    {
    }

    public function index(Request $request)
    {
        $query = Price::with(['market', 'commodity']);

        if ($request->filled('market')) {
            $query->where('market_id', $request->market);
        }

        if ($request->filled('commodity')) {
            $query->where('commodity_id', $request->commodity);
        }

        if ($request->filled('date')) {
            $query->whereDate('price_date', $request->date);
        }

        if ($request->filled('category')) {
            $query->whereHas('commodity', fn ($q) => $q->where('category_id', $request->category));
        }

        $prices = $query->orderByDesc('price_date')->paginate(10);

        return $this->success('Prices retrieved successfully.', PriceResource::collection($prices));
    }

    public function today()
    {
        $prices = Price::with(['market', 'commodity'])
            ->whereDate('price_date', now()->toDateString())
            ->orderBy('market_id')
            ->get();

        return $this->success("Today's prices retrieved successfully.", PriceResource::collection($prices));
    }

    public function compare(Commodity $commodity)
    {
        $prices = Price::with('market')
            ->where('commodity_id', $commodity->id)
            ->whereDate('price_date', now()->toDateString())
            ->get();

        return $this->success('Price comparison retrieved successfully.', [
            'commodity' => $commodity->name,
            'markets' => $prices->map(fn ($price) => [
                'market' => $price->market->name,
                'price' => $price->price,
                'currency' => $price->currency,
            ]),
        ]);
    }

    public function show(Price $price)
    {
        $price->load(['market', 'commodity', 'updatedBy']);

        return $this->success('Price retrieved successfully.', new PriceResource($price));
    }

    public function store(StorePriceRequest $request)
    {
        $price = $this->priceService->create($request->validated());
        $price->load(['market', 'commodity']);

        return $this->success('Price created successfully.', new PriceResource($price), 201);
    }

    public function update(UpdatePriceRequest $request, Price $price)
    {
        $price = $this->priceService->update($price, $request->validated());
        $price->load(['market', 'commodity']);

        return $this->success('Price updated successfully.', new PriceResource($price));
    }

    public function destroy(Price $price)
    {
        $price->delete();

        return $this->success('Price deleted successfully.');
    }
}