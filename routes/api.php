<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\MarketController;
use Illuminate\Support\Facades\Route;

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

Route::get('/markets', [MarketController::class, 'index']);
Route::get('/markets/{market}', [MarketController::class, 'show']);

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);

    Route::post('/markets', [MarketController::class, 'store']);
    Route::put('/markets/{market}', [MarketController::class, 'update']);
    Route::delete('/markets/{market}', [MarketController::class, 'destroy']);
});