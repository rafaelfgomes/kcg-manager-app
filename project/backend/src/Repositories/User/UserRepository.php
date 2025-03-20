<?php

namespace App\Repositories\User;

use App\Models\User;
use App\Repositories\BaseRepository;
use App\Repositories\User\Contracts\UserRepositoryInterface;
use Doctrine\ORM\EntityManager;

class UserRepository extends BaseRepository implements UserRepositoryInterface
{
    public function __construct(
        private EntityManager $entityManager
    ) {
        parent::__construct($entityManager, User::class);
    }

    public function findByEmail(string $email): ?User {
        return $this->repository->findOneBy(['email' => $email]);
    }
}