<?php

namespace App\Repositories\Admin;

use App\DTO\Admin\AdminDTO;
use App\Models\Admin;
use App\Models\User;
use App\Repositories\Admin\Contracts\AdminRepositoryInterface;
use App\Repositories\BaseRepository;
use Doctrine\ORM\EntityManager;

class AdminRepository extends BaseRepository implements AdminRepositoryInterface
{
    public function __construct(
        private EntityManager $entityManager
    ) {
        parent::__construct($entityManager, Admin::class);
    }

    public function createNewAdmin(User $user, string $password): Admin
    {
        return $this->entityManager->wrapInTransaction(function () use ($user, $password) {
            $this->entityManager->persist($user);

            $adminData = [
                'password' => $password,
                'user' => $user
            ];

            $admin = AdminDTO::fillAdminEntity($adminData);

            $this->entityManager->persist($admin);

            $this->entityManager->flush();

            return $admin;
        });
    }
}