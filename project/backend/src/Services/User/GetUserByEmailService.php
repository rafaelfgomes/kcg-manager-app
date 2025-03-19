<?php

namespace App\Services\User;

use App\DTO\User\UserDTO;
use App\Repositories\User\Contracts\UserRepositoryInterface;
use App\Services\User\Contracts\GetUserByEmailServiceInterface;

class GetUserByEmailService implements GetUserByEmailServiceInterface
{
    public function __construct(
        private UserRepositoryInterface $userRepository
    ) {}

    public function execute(string $email): ?array
    {
        $user = $this->userRepository->findByEmail($email);

        if (! $user) {
            return null;
        }

        return UserDTO::fromEntity($user);
    }
}