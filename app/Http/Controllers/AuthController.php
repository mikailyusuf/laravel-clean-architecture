<?php

namespace App\Http\Controllers;

use App\Shared\Responses\ApiResponse;
use App\Application\UseCases\RegisterUserUseCase;
use App\Application\UseCases\LoginUserUseCase;
use App\Application\DTOs\RegisterUserDTO;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AuthController extends Controller
{
    public function register(Request $request, RegisterUserUseCase $useCase)
    {
        try {
            $dto = RegisterUserDTO::fromRequest($request);
            $user = $useCase->execute($dto);

            $token = $user->createToken('auth_token')->plainTextToken;

            return ApiResponse::success([
                'user' => $user,
                'token' => $token
            ], 'User registered successfully');
        } catch (\Exception $e) {
            return ApiResponse::error($e->getMessage());
        }
    }

    public function login(Request $request, LoginUserUseCase $useCase)
    {
        try {
            $user = $useCase->execute(
                $request->email,
                $request->password
            );

            $token = $user->createToken('auth_token')->plainTextToken;

            return ApiResponse::success([
                'user' => $user,
                'token' => $token
            ], 'Login successful');
        } catch (\Exception $e) {
            return ApiResponse::error('Invalid credentials');
        }
    }
}
