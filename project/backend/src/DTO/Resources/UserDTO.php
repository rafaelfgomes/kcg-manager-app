<?php

namespace App\DTO\Resources;

use App\Models\User;

class UserDTO
{
    public function __construct(
        public readonly ?int $id,
        public readonly string $name,
        public readonly string $email
    ) {
    }

    public static function fromEntity(User $user): array
    {
        $userDTO = new self(
            id: $user->getId(),
            name: $user->getName(),
            email: $user->getEmail()
        );

        return (array) $userDTO;
    }
}
