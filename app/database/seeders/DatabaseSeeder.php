<?php

namespace Database\Seeders;

use App\Models\Commission;
use App\Models\Product;
use App\Models\Seller;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $seller = Seller::create(['name' => 'ali piri', 'mobile'=> '09361182258']);
        Product::insert([
            ['name'=> 'Iron 1', 'price'=> 1000],
            ['name'=> 'Iron 2', 'price'=> 2000],
            ['name'=> 'Iron 3', 'price'=> 3000],
            ['name'=> 'Iron 4', 'price'=> 4000],
        ]);
        $seller->products()->sync([1, 2, 3, 4]);
        Commission::insert([
            ['product_id' => 1, 'min' => 0, 'max' => 19, 'percent' => 0.1],
            ['product_id' => 1, 'min' => 20, 'max' => 100, 'percent' => 0.2],
            ['product_id' => 1, 'min' => 101, 'max' => 500, 'percent' => 0.3],
            ['product_id' => 2, 'min' => 0, 'max' => 19, 'percent' => 0.1],
            ['product_id' => 2, 'min' => 20, 'max' => 100, 'percent' => 0.2],
            ['product_id' => 2, 'min' => 101, 'max' => 500, 'percent' => 0.3],
            ['product_id' => 3, 'min' => 0, 'max' => 19, 'percent' => 0.1],
            ['product_id' => 3, 'min' => 20, 'max' => 100, 'percent' => 0.2],
            ['product_id' => 3, 'min' => 101, 'max' => 500, 'percent' => 0.3],
        ]);

    }
}
