<?php

namespace App\Http\Controllers;

use App\Application\UseCases\CreateOrderUseCase;
use App\Application\DTOs\CreateOrderDTO;
use App\Domain\Repositories\OrderRepositoryInterface;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Shared\Responses\ApiResponse;
use App\Http\Resources\OrderResource;

class OrderController extends Controller
{
    public function store(Request $request, CreateOrderUseCase $useCase)
    {
        try {
            $dto = CreateOrderDTO::fromRequest($request);

            $order = $useCase->execute($dto);

            return ApiResponse::success($order, 'Order created successfully');
        } catch (\Exception $e) {
            return ApiResponse::error($e->getMessage());
        }
    }

    public function index(OrderRepositoryInterface $repo)
    {
        $orders = $repo->all();

        return ApiResponse::success(OrderResource::collection($orders));
    }
}
