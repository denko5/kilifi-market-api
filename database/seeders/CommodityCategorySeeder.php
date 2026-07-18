<?php

namespace Database\Seeders;

use App\Models\CommodityCategory;
use Illuminate\Database\Seeder;

class CommodityCategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            'Vegetables',
            'Fruits',
            'Fish',
            'Livestock',
            'Cereals',
            'Nuts',
            'Root Crops',
        ];

        foreach ($categories as $name) {
            CommodityCategory::firstOrCreate(['name' => $name]);
        }
    }
}