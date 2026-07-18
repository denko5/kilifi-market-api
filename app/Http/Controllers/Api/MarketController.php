<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Market\StoreMarketRequest;
use App\Http\Requests\Market\UpdateMarketRequest;
use App\Http\Resources\MarketResource;
use App\Http\Traits\ApiResponse;
use App\Models\Market;

class MarketController extends Controller
{
    use ApiResponse;

    public function index()
    {
        $markets = Market::orderBy('name')->paginate(10);

        return $this->success('Markets retrieved successfully.', MarketResource::collection($markets));
    }

    public function show(Market $market)
    {
        return $this->success('Market retrieved successfully.', new MarketResource($market));
    }

    public function store(StoreMarketRequest $request)
    {
        $market = Market::create($request->validated());

        return $this->success('Market created successfully.', new MarketResource($market), 201);
    }

    public function update(UpdateMarketRequest $request, Market $market)
    {
        $market->update($request->validated());

        return $this->success('Market updated successfully.', new MarketResource($market));
    }

    public function destroy(Market $market)
    {
        $market->delete();

        return $this->success('Market deleted successfully.');
    }
}