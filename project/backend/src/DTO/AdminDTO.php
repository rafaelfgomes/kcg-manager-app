<?php

namespace App\DTO;

use App\Entities\Admin;

class AdminDTO implements DTOInterface
{
    public function __construct(
        public readonly ?int $id = null,
        public readonly ?string $name = null,
        public readonly ?string $email = null,
    ) {}

    public function fillDatafromEntity(object $admin): array
    {
        $adminDTO = new self(
            id: $admin->getId(),
            name: $admin->getName(),
            email: $admin->getEmail()
        );

        return (array) $adminDTO;
    }

    public function fillEntity(array $data): object
    {
        return new Admin(
            name: $data['name'],
            email: $data['email'],
            password: $data['password'],
            id: $data['id'] ?? null
        );
    }
}