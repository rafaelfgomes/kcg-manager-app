<?php

namespace App\Services\Admin;

use App\DTO\Admin\AdminDTO;
use App\Repositories\Admin\Contracts\AdminRepositoryInterface;
use App\Services\Admin\Contracts\GetAdminByEmailServiceInterface;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class GetAdminByEmailService implements GetAdminByEmailServiceInterface
{
    public function __construct(
        private AdminRepositoryInterface $adminRepository
    ) {}

    public function execute(string $email): ?array
    {
        $admin = $this->adminRepository->findByEmail($email);

        if (empty($admin)) {
            return null;
        }

        return ['admin' => AdminDTO::fillDatafromEntity($admin)];
    }
}