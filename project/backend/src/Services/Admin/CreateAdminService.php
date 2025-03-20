<?php

namespace App\Services\Admin;

use App\DTO\Admin\AdminDTO;
use App\Repositories\Admin\Contracts\AdminRepositoryInterface;
use App\Repositories\User\Contracts\UserRepositoryInterface;
use App\Services\Admin\Contracts\CreateAdminServiceInterface;
use Exception;

class CreateAdminService implements CreateAdminServiceInterface
{
    public function __construct(
        private AdminRepositoryInterface $adminRepository,
        private UserRepositoryInterface $userRepository
    ) {}

    public function execute(array $data): ?array
    {
        $user = $this->userRepository->findById($data['user_id']);

        if (! $user) {
            throw new Exception('Erro ao buscar o uauário');
        }

        unset($data['user_id']);

        $data['user'] = $user;

        $newAdmin = AdminDTO::fillAdminEntity($data);

        $admin = $this->adminRepository->create($newAdmin);

        if (! $admin) {
            return null;
        }

        return AdminDTO::fillDTOfromEntity($admin);
    }
}