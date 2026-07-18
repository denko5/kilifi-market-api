<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UsersSeeder extends Seeder
{
    public function run(): void
    {
        User::firstOrCreate(
            ['email' => 'admin@kilifimarket.test'],
            [
                'name' => 'Denis Kombe',
                'password' => 'password123',
                'role' => 'admin',
            ]
        );
    }
}