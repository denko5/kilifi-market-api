<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Commodity\StoreCommodityRequest;
use App\Http\Requests\Commodity\UpdateCommodityRequest;
use App\Http\Resources\CommodityResource;
use App\Http\Traits\ApiResponse;
use App\Models\Commodity;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CommodityController extends Controller
{
    use ApiResponse;

    public function index(Request $request)
    {
        $query = Commodity::with('category');

        if ($request->filled('search')) {
            $query->where('name', 'like', '%'.$request->search.'%');
        }

        if ($request->filled('category')) {
            $query->where('category_id', $request->category);
        }

        $commodities = $query->orderBy('name')->paginate(10);

        return $this->success('Commodities retrieved successfully.', CommodityResource::collection($commodities));
    }

    public function show(Commodity $commodity)
    {
        $commodity->load('category');

        return $this->success('Commodity retrieved successfully.', new CommodityResource($commodity));
    }

    public function store(StoreCommodityRequest $request)
    {
        $data = $request->validated();

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('commodities', 'public');
        }

        $commodity = Commodity::create($data);
        $commodity->load('category');

        return $this->success('Commodity created successfully.', new CommodityResource($commodity), 201);
    }

    public function update(UpdateCommodityRequest $request, Commodity $commodity)
    {
        $data = $request->validated();

        if ($request->hasFile('image')) {
            if ($commodity->image) {
                Storage::disk('public')->delete($commodity->image);
            }
            $data['image'] = $request->file('image')->store('commodities', 'public');
        }

        $commodity->update($data);
        $commodity->load('category');

        return $this->success('Commodity updated successfully.', new CommodityResource($commodity));
    }

    public function destroy(Commodity $commodity)
    {
        if ($commodity->image) {
            Storage::disk('public')->delete($commodity->image);
        }

        $commodity->delete();

        return $this->success('Commodity deleted successfully.');
    }
}