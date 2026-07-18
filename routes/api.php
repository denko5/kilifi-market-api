<?php

use Illuminate\Support\Facades\Route;

Route::get('/ping', function () {
    return response()->json([
        'success' => true,
        'message' => 'API route is working.',
    ]);
});