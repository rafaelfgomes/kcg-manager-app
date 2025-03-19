<?php

namespace App\Services\User;

use App\DTO\Collections\UserCollection;
use App\Repositories\User\Contracts\UserRepositoryInterface;
use App\Services\User\Contracts\GetAllUsersServiceInterface;

class GetAllUsersService implements GetAllUsersServiceInterface
{
    public function __construct(
        private UserRepositoryInterface $userRepository
    ) {    
    }

    public function listAllUsers(): ?array
    {
        $users = $this->userRepository->getAll();

        if (empty($users)) {
            return null;
        }

        return UserCollection::list($users);
    }
}