<?php

namespace App\Services\Admin;

use App\DTO\Admin\AdminCollection;
use App\DTO\Admin\AdminDTO;
use App\Repositories\Admin\Contracts\AdminRepositoryInterface;
use App\Services\Admin\Contracts\GetAllAdminsServiceInterface;

class GetAllAdminsService implements GetAllAdminsServiceInterface
{
    public function __construct(
        private AdminRepositoryInterface $adminRepository
    ) {}

    public function execute(): ?array
    {
        $admins = $this->adminRepository->getAll();

        if (empty($admins)) {
            return null;
        }

        return AdminCollection::list($admins);
    }
}