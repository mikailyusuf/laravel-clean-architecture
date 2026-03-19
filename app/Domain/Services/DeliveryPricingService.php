<?php
namespace App\Domain\Services;

class DeliveryPricingService
{
    public function calculate(float $distance, float $weight): float
    {
        $baseFare = 500; // base fee
        $distanceCost = $distance * 100;
        $weightCost = $weight * 50;

        return $baseFare + $distanceCost + $weightCost;
    }
}
