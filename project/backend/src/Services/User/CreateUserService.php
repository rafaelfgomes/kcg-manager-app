<?php

namespace App\Services\User;

use App\DTO\User\UserDTO;
use App\Repositories\User\Contracts\UserRepositoryInterface;
use App\Services\User\Contracts\CreateUserServiceInterface;

class CreateUserService implements CreateUserServiceInterface
{
    public function __construct(
        private UserRepositoryInterface $userRepository
    ) {}

    public function execute(array $data): ?array
    {
        $newUser = UserDTO::fillUserEntity($data);

        $user = $this->userRepository->create($newUser);

        if (! $user) {
            return null;
        }

        return UserDTO::fillDTOfromEntity($user);
    }
}