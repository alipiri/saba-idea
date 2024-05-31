<?php

namespace App\Http\Traits;

use App\Models\Order;
use App\Models\Product;
use App\Models\OrderHead;
use App\Models\Commission;

trait OrderTrait
{
    public function createOrder(int $orderHeadId,array $productArray)
    {
        $product = Product::find($productArray[0]);
        $amount  = $productArray[1];
        $totalPrice = $product->price * $amount;

        return Order::create([
            'order_head_id' => $orderHeadId,
            'product_id'    => $productArray[0],
            'amount'    => $amount,
            'product_price' => $product->price,
            'total_price' => $totalPrice,
            'commission'  => $this->calculateCommission($productArray[0], $amount, $totalPrice)
        ]);
    }


    public function calculateCommission(int $productId, int $amount, int $totalPrice)
    {
        $commission = Commission::whereProductId($productId)->where('min', '<=', $amount)->where('max', '>=', $amount)->first();
        if ($commission)
        {
            return (int)($commission->percent * $totalPrice);
        }

        $maximumCommission = Commission::orderByDesc('max')->first();
        if ($amount > $maximumCommission)
        {
            return (int)($maximumCommission->percent * $totalPrice);
        }

        return 0;
    }

}
