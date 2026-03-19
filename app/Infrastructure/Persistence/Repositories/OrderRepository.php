<?php

namespace App\Infrastructure\Persistence\Repositories;
use App\Models\Order;
use App\Domain\Repositories\OrderRepositoryInterface;

class OrderRepository implements OrderRepositoryInterface
{
    public function create(array $data)
    {
        return Order::create($data);
    }

    public function all()
    {
        return Order::latest()->get();
    }
}
