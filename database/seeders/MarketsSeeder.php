<?php

namespace Database\Seeders;

use App\Models\Market;
use Illuminate\Database\Seeder;

class MarketsSeeder extends Seeder
{
    public function run(): void
    {
        $markets = [
            ['name' => 'Kilifi Town Market', 'location' => 'Kilifi', 'latitude' => -3.6305, 'longitude' => 39.8499],
            ['name' => 'Mtwapa Market', 'location' => 'Mtwapa', 'latitude' => -3.9450, 'longitude' => 39.7469],
            ['name' => 'Mariakani Market', 'location' => 'Mariakani', 'latitude' => -3.8642, 'longitude' => 39.4728],
            ['name' => 'Malindi Market', 'location' => 'Malindi', 'latitude' => -3.2192, 'longitude' => 40.1169],
            ['name' => 'Bamba Market', 'location' => 'Bamba', 'latitude' => -3.5333, 'longitude' => 39.6500],
            ['name' => 'Mazeras Market', 'location' => 'Mazeras', 'latitude' => -3.9833, 'longitude' => 39.5667],
            ['name' => 'Kaloleni Market', 'location' => 'Kaloleni', 'latitude' => -3.8500, 'longitude' => 39.6500],
            ['name' => 'Rabai Market', 'location' => 'Rabai', 'latitude' => -3.9167, 'longitude' => 39.6000],
            ['name' => 'Ganze Market', 'location' => 'Ganze', 'latitude' => -3.4333, 'longitude' => 39.6500],
            ['name' => 'Mtwapa Fish Market', 'location' => 'Mtwapa', 'latitude' => -3.9450, 'longitude' => 39.7469],
        ];

        foreach ($markets as $market) {
            Market::updateOrCreate(
                ['name' => $market['name']],
                $market
            );
        }
    }
}