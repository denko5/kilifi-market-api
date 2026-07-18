<?php

namespace Database\Seeders;

use App\Models\Market;
use Illuminate\Database\Seeder;

class MarketsSeeder extends Seeder
{
    public function run(): void
    {
        $markets = [
            ['name' => 'Kilifi Town Market', 'location' => 'Kilifi'],
            ['name' => 'Mtwapa Market', 'location' => 'Mtwapa'],
            ['name' => 'Mariakani Market', 'location' => 'Mariakani'],
            ['name' => 'Malindi Market', 'location' => 'Malindi'],
            ['name' => 'Bamba Market', 'location' => 'Bamba'],
            ['name' => 'Mazeras Market', 'location' => 'Mazeras'],
            ['name' => 'Kaloleni Market', 'location' => 'Kaloleni'],
            ['name' => 'Rabai Market', 'location' => 'Rabai'],
            ['name' => 'Ganze Market', 'location' => 'Ganze'],
            ['name' => 'Mtwapa Fish Market', 'location' => 'Mtwapa'],
        ];

        foreach ($markets as $market) {
            Market::firstOrCreate(
                ['name' => $market['name']],
                $market
            );
        }
    }
}