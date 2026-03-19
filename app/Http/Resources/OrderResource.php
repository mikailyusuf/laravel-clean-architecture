<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
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
            'id' => $this->id,
            'pickup_address' => $this->pickup_address,
            'delivery_address' => $this->delivery_address,
            'distance' => $this->distance,
            'weight' => $this->weight,
            'price' => $this->price,
            'status' => $this->status,
            'customer' => [
                'id' => $this->user?->id,
                'name' => $this->user?->name,
            ],

            'created_at' => $this->created_at->toDateTimeString(),
        ];
    }
}
