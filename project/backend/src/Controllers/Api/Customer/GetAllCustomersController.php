<?php

namespace App\Controllers\Api\Customer;

use App\Services\Customer\Contracts\GetCustomerServiceInterface;
use Exception;
use Symfony\Component\HttpFoundation\JsonResponse;

class GetAllCustomersController
{
    public function __construct(
        private GetCustomerServiceInterface $getCustomerService
    ) {
    }

    public function __invoke()
    {
        try {
            $response = $this->getCustomerService->all();

            return new JsonResponse($response);
        } catch (Exception $e) {
            throw $e;
        }   
    }
}