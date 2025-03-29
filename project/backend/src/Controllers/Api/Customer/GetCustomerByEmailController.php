<?php

namespace App\Controllers\Api\Customer;

use App\Services\Customer\Contracts\GetCustomerServiceInterface;
use Exception;
use Symfony\Component\HttpFoundation\JsonResponse;

class GetCustomerByEmailController
{
    public function __construct(
        private GetCustomerServiceInterface $getCustomerService
    ) {}

    public function __invoke(string $email): JsonResponse
    {
        try {
            $response = $this->getCustomerService->byEmail($email);

            return new JsonResponse($response);
        } catch (Exception $e) {
            throw $e;
        }
    }
}