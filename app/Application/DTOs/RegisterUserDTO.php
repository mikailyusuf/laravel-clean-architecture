<?php

namespace App\Application\DTOs;

class RegisterUserDTO
{
    public function __construct(
        public string $name,
        public string $email,
        public string $password,
    ) {}

    public static function fromRequest($request): self
    {
        return new self(
            name: $request->name,
            email: $request->email,
            password: bcrypt($request->password),
        );
    }

    public function toArray(): array
    {
        return get_object_vars($this);
    }
}
