<?php

namespace Database\Seeders;

use App\Models\restaurant;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RestaurantSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        restaurant::factory()->count(20)->create();
    }
}
