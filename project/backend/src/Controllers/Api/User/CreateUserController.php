<?php

namespace App\Controllers\Api\User;

use App\Services\User\Contracts\CreateUserServiceInterface;
use Exception;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class CreateUserController
{
    public function __construct(
        private CreateUserServiceInterface $createUserService
    ) {}

    public function __invoke(Request $request): JsonResponse
    {
        try {
            dd($request->getContent());

            $data = json_decode($request->getContent(), true);

            $user = $this->createUserService->execute($data);

            return new JsonResponse(['user' => $user]);
        } catch (Exception $e) {
            throw $e;
        }
    }
}