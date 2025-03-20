<?php

namespace App\DTO\Admin;

use App\Models\Admin;
use App\Support\Hash;

class AdminDTO
{
    public function __construct(
        public readonly string $name,
        public readonly string $email,
    ) {}

    public static function fillDTOfromEntity(Admin $admin): array
    {
        $adminDTO = new self(
            name: $admin->getUser()->getName(),
            email: $admin->getUser()->getEmail()
        );

        return (array) $adminDTO;
    }

    public static function fillAdminEntity(array $data): Admin
    {
        return new Admin(
            password: Hash::make($data['password']),
            user: $data['user'],
        );
    }
}