<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\CommodityCategory\StoreCommodityCategoryRequest;
use App\Http\Requests\CommodityCategory\UpdateCommodityCategoryRequest;
use App\Http\Resources\CommodityCategoryResource;
use App\Http\Traits\ApiResponse;
use App\Models\CommodityCategory;

class CommodityCategoryController extends Controller
{
    use ApiResponse;

    public function index()
    {
        $categories = CommodityCategory::withCount('commodities')
            ->orderBy('name')
            ->get();

        return $this->success('Commodity categories retrieved successfully.', CommodityCategoryResource::collection($categories));
    }

    public function show(CommodityCategory $commodityCategory)
    {
        $commodityCategory->loadCount('commodities');

        return $this->success('Commodity category retrieved successfully.', new CommodityCategoryResource($commodityCategory));
    }

    public function store(StoreCommodityCategoryRequest $request)
    {
        $category = CommodityCategory::create($request->validated());

        return $this->success('Commodity category created successfully.', new CommodityCategoryResource($category), 201);
    }

    public function update(UpdateCommodityCategoryRequest $request, CommodityCategory $commodityCategory)
    {
        $commodityCategory->update($request->validated());

        return $this->success('Commodity category updated successfully.', new CommodityCategoryResource($commodityCategory));
    }

    public function destroy(CommodityCategory $commodityCategory)
    {
        $commodityCategory->delete();

        return $this->success('Commodity category deleted successfully.');
    }
}