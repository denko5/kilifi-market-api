<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Traits\ApiResponse;
use App\Models\Commodity;
use App\Models\Market;
use App\Models\Price;
use App\Models\User;

class DashboardController extends Controller
{
    use ApiResponse;

    public function index()
    {
        $stats = [
            'markets' => Market::count(),
            'commodities' => Commodity::count(),
            'prices_updated_today' => Price::whereDate('price_date', now()->toDateString())->count(),
            'users' => User::count(),
        ];

        return $this->success('Dashboard statistics retrieved successfully.', $stats);
    }
}