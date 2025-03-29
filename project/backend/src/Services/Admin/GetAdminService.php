<?php

namespace App\Services\Admin;

use App\DTO\AdminDTO;
use App\Repositories\Admin\Contracts\AdminRepositoryInterface;
use App\Services\Admin\Contracts\GetAdminServiceInterface;

class GetAdminService implements GetAdminServiceInterface
{
    public function __construct(
        private AdminRepositoryInterface $adminRepository,
        private AdminDTO $adminDTO
    ) {}

    public function byEmail(string $email): ?array
    {
        $admin = $this->adminRepository->findByEmail($email);

        if (empty($admin)) {
            return null;
        }

        return ['admin' => $this->adminDTO->fillDatafromEntity($admin)];
    }
}