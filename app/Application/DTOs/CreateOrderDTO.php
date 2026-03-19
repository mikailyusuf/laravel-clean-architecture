<?php 

namespace App\Application\DTOs;
class CreateOrderDTO
{
    public function __construct(
        public int $user_id,
        public string $pickup_address,
        public string $delivery_address,
        public float $distance,
        public float $weight
    ) {}

    public static function fromRequest($request): self
    {
        return new self(
            user_id: auth()->id(),
            pickup_address: $request->pickup_address,
            delivery_address: $request->delivery_address,
            distance: $request->distance,
            weight: $request->weight,
        );
    }

    public function toArray(): array
    {
        return get_object_vars($this);
    }
}