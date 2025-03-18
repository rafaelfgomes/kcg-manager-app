<?php

namespace App\Services\User;

use App\Repositories\User\Contracts\UserRepositoryInterface;
use App\Services\User\Contracts\GetAllUsersServiceInterface;

class GetAllUsersService implements GetAllUsersServiceInterface
{
    public function __construct(
        private UserRepositoryInterface $userRepository
    ) {    
    }

    public function listAllUsers(): array
    {
        return $this->userRepository->getAll();
    }
}