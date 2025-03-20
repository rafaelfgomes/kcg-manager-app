<?php

namespace App\Services\User;

use App\DTO\User\UserCollection;
use App\Repositories\User\Contracts\UserRepositoryInterface;
use App\Services\User\Contracts\GetAllUsersServiceInterface;

class GetAllUsersService implements GetAllUsersServiceInterface
{
    public function __construct(
        private UserRepositoryInterface $userRepository
    ) {    
    }

    public function execute(): ?array
    {
        $users = $this->userRepository->getAll();

        if (empty($users)) {
            return null;
        }

        return UserCollection::list($users);
    }
}