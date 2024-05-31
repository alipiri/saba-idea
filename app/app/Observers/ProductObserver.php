<?php

namespace App\Observers;

use App\Models\Commission;
use App\Models\Product;
use Carbon\Carbon;

class ProductObserver
{
    public function created(Product $product)
    {
        $array = [
            0 => [
                'product_id' => $product->id,
                'min' => 1,
                'max' => 20,
                'percent' => 0.05,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            1 => [
                'product_id' => $product->id,
                'min' => 21,
                'max' => 100,
                'percent' => 0.1,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            2 => [
                'product_id' => $product->id,
                'min' => 101,
                'max' => 500,
                'percent' => 0.3,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
        ];

        Commission::insert($array);
    }
}
