<?php

namespace App\Application\UseCases;

use App\Domain\Repositories\UserRepositoryInterface;
use App\Application\DTOs\RegisterUserDTO;

class RegisterUserUseCase
{
    public function __construct(
        private UserRepositoryInterface $repo
    ) {}

    public function execute(RegisterUserDTO $dto)
    {
        return $this->repo->create($dto->toArray());
    }
}
