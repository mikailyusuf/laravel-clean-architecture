<?php

namespace App\Domain\Repositories;

interface OrderRepositoryInterface
{
    public function create(array $data);
    public function all();
}
