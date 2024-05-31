<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use App\Http\Resources\ProductResource;
use Illuminate\Http\Resources\Json\JsonResource;

class OrderResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'product' => new ProductResource($this->whenLoaded('product')),
            'amount'  => $this->amount,
            'product_price'  => $this->product_price,
            'total_price'  => $this->total_price,
            'commission'  => $this->commission,
        ];
    }
}
