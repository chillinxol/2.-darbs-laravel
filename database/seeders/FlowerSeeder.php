<?php

namespace Database\Seeders;

use App\Models\Flower;
use Illuminate\Database\Seeder;

class FlowerSeeder extends Seeder
{
    public function run()
    {
        Flower::create([
            'name' => 'Rose',
            'description' => 'Beautiful red rose',
            'price' => 10.00,
        ]);
        Flower::create([
            'name' => 'Tulip',
            'description' => 'Colorful tulips',
            'price' => 12.50,
        ]);
        Flower::create([
            'name' => 'Lily',
            'description' => 'Elegant lilies',
            'price' => 15.00,
        ]);
    }
}
