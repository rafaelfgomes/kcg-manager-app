<?php

namespace App\Controllers\Api\Admin;

use App\Services\Admin\Contracts\GetAdminByEmailServiceInterface;
use Exception;
use Symfony\Component\HttpFoundation\JsonResponse;

class GetAdminByEmailController {

    public function __construct(
        private GetAdminByEmailServiceInterface $getAdminByEmailService
    ) {}

    public function __invoke(string $email)
    {
        try {
            $response = $this->getAdminByEmailService->execute($email);

            return new JsonResponse($response);
        } catch (Exception $e) {
            throw $e;
        }
        
    }
}