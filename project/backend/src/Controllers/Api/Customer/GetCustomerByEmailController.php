<?php

namespace App\Controllers\Api\Customer;

use App\Services\Customer\Contracts\GetCustomerByEmailServiceInterface;
use Exception;
use Symfony\Component\HttpFoundation\JsonResponse;

class GetCustomerByEmailController
{
    public function __construct(
        private GetCustomerByEmailServiceInterface $getCustomerByEmailService
    ) {}

    public function __invoke(string $email): JsonResponse
    {
        try {
            $response = $this->getCustomerByEmailService->execute($email);

            return new JsonResponse($response);
        } catch (Exception $e) {
            throw $e;
        }
    }
}