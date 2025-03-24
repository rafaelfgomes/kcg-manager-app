<?php

namespace App\DTO\Admin;

use App\Entities\Admin;

class AdminDTO
{
    public function __construct(
        public readonly ?int $id,
        public readonly string $name,
        public readonly string $email
    ) {}

    public static function fillDatafromEntity(Admin $admin): array
    {
        $adminDTO = new self(
            id: $admin->getId(),
            name: $admin->getName(),
            email: $admin->getEmail()
        );

        return (array) $adminDTO;
    }

    public static function fillEntity(array $data): Admin
    {
        return new Admin(
            name: $data['name'],
            email: $data['email'],
            password: $data['password'],
            id: $data['id'] ?? null
        );
    }
}