<?php

namespace App\Controllers\Api\User;

use App\Services\User\Contracts\GetAllUsersServiceInterface;
use Symfony\Component\HttpFoundation\JsonResponse;

class GetAllUsersController
{
    public function __construct(
        private GetAllUsersServiceInterface $getAllUsersService
    ) {
    }

    public function __invoke()
    {
        $users = $this->getAllUsersService->listAllUsers();

        return new JsonResponse(['users' => $users]);
    }
}