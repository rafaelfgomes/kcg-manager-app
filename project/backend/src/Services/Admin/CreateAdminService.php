<?php

namespace App\Services\Admin;

use App\DTO\AdminDTO;
use App\Repositories\Admin\Contracts\AdminRepositoryInterface;
use App\Services\Admin\Contracts\CreateAdminServiceInterface;
use App\Support\Hash;

class CreateAdminService implements CreateAdminServiceInterface
{
    public function __construct(
        private AdminRepositoryInterface $adminRepository,
        private AdminDTO $adminDTO
    ) {}

    public function execute(array &$data): ?array
    {
        $data['password'] = Hash::make($data['password']);

        $admin = $this->adminDTO->fillEntity($data);

        $newAdmin = $this->adminRepository->create($admin);

        if (! $newAdmin) {
            return null;
        }

        return [
            'message' => $newAdmin->getName() . ' cadastrado com sucesso'
        ];
    }
}