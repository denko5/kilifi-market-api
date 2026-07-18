<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return response()->json([
        'success' => true,
        'message' => 'Kilifi Market Prices Tracker API is running.',
    ]);
});