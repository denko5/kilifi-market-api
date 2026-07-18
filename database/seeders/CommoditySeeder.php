<?php

namespace Database\Seeders;

use App\Models\Commodity;
use App\Models\CommodityCategory;
use Illuminate\Database\Seeder;

class CommoditySeeder extends Seeder
{
    public function run(): void
    {
        $commodities = [
            'Cereals' => [
                ['name' => 'Maize', 'unit' => 'Kg'],
                ['name' => 'Rice', 'unit' => 'Kg'],
            ],
            'Root Crops' => [
                ['name' => 'Cassava', 'unit' => 'Kg'],
                ['name' => 'Sweet Potatoes', 'unit' => 'Kg'],
            ],
            'Vegetables' => [
                ['name' => 'Tomatoes', 'unit' => 'Kg'],
                ['name' => 'Onions', 'unit' => 'Kg'],
                ['name' => 'Kale', 'unit' => 'Kg'],
                ['name' => 'Spinach', 'unit' => 'Kg'],
                ['name' => 'Beans', 'unit' => 'Kg'],
            ],
            'Fruits' => [
                ['name' => 'Mangoes', 'unit' => 'Kg'],
                ['name' => 'Oranges', 'unit' => 'Kg'],
                ['name' => 'Bananas', 'unit' => 'Kg'],
                ['name' => 'Coconuts', 'unit' => 'Piece'],
            ],
            'Nuts' => [
                ['name' => 'Cashew Nuts', 'unit' => 'Kg'],
            ],
            'Fish' => [
                ['name' => 'Tilapia', 'unit' => 'Kg'],
                ['name' => 'Octopus', 'unit' => 'Kg'],
                ['name' => 'Prawns', 'unit' => 'Kg'],
            ],
            'Livestock' => [
                ['name' => 'Goat', 'unit' => 'Kg'],
                ['name' => 'Chicken', 'unit' => 'Piece'],
                ['name' => 'Milk', 'unit' => 'Litre'],
                ['name' => 'Eggs', 'unit' => 'Tray'],
            ],
        ];

        foreach ($commodities as $categoryName => $items) {
            $category = CommodityCategory::where('name', $categoryName)->first();

            foreach ($items as $item) {
                Commodity::firstOrCreate(
                    ['name' => $item['name']],
                    [
                        'category_id' => $category->id,
                        'unit' => $item['unit'],
                    ]
                );
            }
        }
    }
}