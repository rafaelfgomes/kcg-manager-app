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
        $user = $this->userRepository->create((object) $data);

        if (! $user) {
            return null;
        }

        return UserDTO::fromEntity((object) $data);
    }
}