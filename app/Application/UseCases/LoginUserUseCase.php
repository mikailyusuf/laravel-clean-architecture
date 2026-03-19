<?php
namespace App\Application\UseCases;
use Illuminate\Support\Facades\Hash;
use App\Domain\Repositories\UserRepositoryInterface;


class LoginUserUseCase
{
    public function __construct(
        private UserRepositoryInterface $repo
    ) {}

    public function execute($email, $password)
    {
        $user = $this->repo->findByEmail($email);

        if (!$user || !Hash::check($password, $user->password)) {
            throw new \Exception('Invalid credentials');
        }

        return $user;
    }
}
