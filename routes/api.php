<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\MarketController;
use App\Http\Controllers\Api\CommodityCategoryController;
use App\Http\Controllers\Api\CommodityController;
use App\Http\Controllers\Api\PriceController;
use Illuminate\Support\Facades\Route;

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

Route::get('/markets', [MarketController::class, 'index']);
Route::get('/markets/{market}', [MarketController::class, 'show']);

Route::get('/commodity-categories', [CommodityCategoryController::class, 'index']);
Route::get('/commodity-categories/{commodity_category}', [CommodityCategoryController::class, 'show']);

Route::get('/commodities', [CommodityController::class, 'index']);
Route::get('/commodities/{commodity}', [CommodityController::class, 'show']);

Route::get('/prices', [PriceController::class, 'index']);
Route::get('/prices/today', [PriceController::class, 'today']);
Route::get('/prices/compare/{commodity}', [PriceController::class, 'compare']);
Route::get('/prices/{price}', [PriceController::class, 'show']);

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);

    Route::post('/markets', [MarketController::class, 'store']);
    Route::put('/markets/{market}', [MarketController::class, 'update']);
    Route::delete('/markets/{market}', [MarketController::class, 'destroy']);

    Route::post('/commodity-categories', [CommodityCategoryController::class, 'store']);
    Route::put('/commodity-categories/{commodity_category}', [CommodityCategoryController::class, 'update']);
    Route::delete('/commodity-categories/{commodity_category}', [CommodityCategoryController::class, 'destroy']);

    Route::post('/commodities', [CommodityController::class, 'store']);
    Route::put('/commodities/{commodity}', [CommodityController::class, 'update']);
    Route::delete('/commodities/{commodity}', [CommodityController::class, 'destroy']);

    Route::post('/prices', [PriceController::class, 'store']);
    Route::put('/prices/{price}', [PriceController::class, 'update']);
    Route::delete('/prices/{price}', [PriceController::class, 'destroy']);
});