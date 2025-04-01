<?php

namespace App\Controllers\Api\Customer;

use App\Services\Customer\Contracts\CreateCustomerServiceInterface;
use Exception;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class CreateCustomerController
{
    public function __construct(
        private CreateCustomerServiceInterface $createCustomerService
    ) {}

    public function __invoke(Request $request): JsonResponse
    {
        try {
            $data = json_decode($request->getContent(), true);

            $response = $this->createCustomerService->execute($data);

            return new JsonResponse($response, Response::HTTP_CREATED);
        } catch (Exception $e) {
            throw $e;
        }
    }
}