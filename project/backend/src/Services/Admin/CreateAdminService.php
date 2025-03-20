<?php

namespace App\Services\Admin;

use App\DTO\Admin\AdminDTO;
use App\DTO\User\UserDTO;
use App\Repositories\Admin\Contracts\AdminRepositoryInterface;
use App\Services\Admin\Contracts\CreateAdminServiceInterface;
use App\Support\Hash;

class CreateAdminService implements CreateAdminServiceInterface
{
    public function __construct(
        private AdminRepositoryInterface $adminRepository
    ) {}

    public function execute(array $data): ?array
    {
        $password = Hash::make($data['password']);

        unset($data['password']);

        $userDTO = UserDTO::fillUserEntity($data);

        $newAdmin = $this->adminRepository->createNewAdmin($userDTO, $password);

        return AdminDTO::fillDTOfromEntity($newAdmin);
    }
}