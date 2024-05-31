<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Resources\OrderResource;
use Illuminate\Http\Resources\Json\JsonResource;

class OrderHeadResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'total_price' => $this->total_price,
            'commission' => $this->commission,
            'created_at'  => Carbon::parse($this->created_at)->format('Y-m-d H:i:s'),
            'orders' => OrderResource::collection($this->whenLoaded('orders')),
            'user'   => new UserResource($this->whenLoaded('user')),
            'seller'   => new SellerResource($this->whenLoaded('seller')),
        ];
    }
}
