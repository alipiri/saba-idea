<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SellerResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'mobile' => $this->mobile,
            'products' => ProductResource::collection($this->whenLoaded('products')),
            'commissions' => CommissionResource::collection($this->whenLoaded('commissions')),
            'orders' => OrderHeadResource::collection($this->whenLoaded('orderHeads')),
        ];
    }
}
