<?php

namespace App\Controllers\Api\Customer;

use App\Services\Customer\Contracts\GetAllCustomersServiceInterface;
use Exception;
use Symfony\Component\HttpFoundation\JsonResponse;

class GetAllCustomersController
{
    public function __construct(
        private GetAllCustomersServiceInterface $getAllCustomerssService
    ) {
    }

    public function __invoke()
    {
        try {
            $response = $this->getAllCustomerssService->execute();

            return new JsonResponse($response);
        } catch (Exception $e) {
            throw $e;
        }   
    }
}