<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CommissionResource extends JsonResource
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
            'min' => $this->min,
            'max' => $this->max,
            'percent' => $this->percent * 100,
            'product' => new ProductResource($this->whenLoaded('product'))
        ];
    }
}
