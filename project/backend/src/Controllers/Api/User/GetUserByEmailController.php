<?php

namespace App\Controllers\Api\User;

use App\Services\User\Contracts\GetUserByEmailServiceInterface;
use Exception;
use Symfony\Component\HttpFoundation\JsonResponse;

class GetUserByEmailController
{
    public function __construct(
        private GetUserByEmailServiceInterface $getUserByEmailService
    ) {}

    public function __invoke(string $email): JsonResponse
    {
        try {
            $user = $this->getUserByEmailService->execute($email);

            return new JsonResponse(['user' => $user]);
        } catch (Exception $e) {
            throw $e;
        }
    }
}