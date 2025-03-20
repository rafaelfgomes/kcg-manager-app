<?php

namespace App\DTO\User;

use App\Models\User;

class UserDTO
{
    public function __construct(
        public readonly ?int $id,
        public readonly string $name,
        public readonly string $email
    ) {
    }

    public static function fillDTOfromEntity(User $user): array
    {
        $userDTO = new self(
            id: $user->getId(),
            name: $user->getName(),
            email: $user->getEmail()
        );

        return (array) $userDTO;
    }

    public static function fillUserEntity(array $data): User
    {
        return new User(
            name: $data['name'],
            email: $data['email'],
        );
    }
}
