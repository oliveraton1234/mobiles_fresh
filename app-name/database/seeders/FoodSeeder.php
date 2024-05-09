<?php

namespace Database\Seeders;

use App\Models\food;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FoodSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        food::factory()->count(20)->create();
    }
}
