<?php 
namespace App\Application\UseCases;

use App\Domain\Repositories\OrderRepositoryInterface;
use App\Domain\Services\DeliveryPricingService;
use App\Application\DTOs\CreateOrderDTO;

class CreateOrderUseCase
{
    public function __construct(
        private OrderRepositoryInterface $repo,
        private DeliveryPricingService $pricingService
    ) {}

    public function execute(CreateOrderDTO $dto)
    {
        $price = $this->pricingService->calculate(
            $dto->distance,
            $dto->weight
        );

        return $this->repo->create([
            ...$dto->toArray(),
            'price' => $price,
        ]);
    }
}