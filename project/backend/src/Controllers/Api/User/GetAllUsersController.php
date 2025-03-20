<?php

namespace App\Controllers\Api\User;

use App\Services\User\Contracts\GetAllUsersServiceInterface;
use Exception;
use Symfony\Component\HttpFoundation\JsonResponse;

class GetAllUsersController
{
    public function __construct(
        private GetAllUsersServiceInterface $getAllUsersService
    ) {
    }

    public function __invoke()
    {
        try {
            $users = $this->getAllUsersService->execute();

            return new JsonResponse(['users' => $users]);
        } catch (Exception $e) {
            throw $e;
        }   
    }
}