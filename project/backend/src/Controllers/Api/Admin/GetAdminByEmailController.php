<?php

namespace App\Controllers\Api\Admin;

use App\Services\Admin\Contracts\GetAdminServiceInterface;
use Exception;
use Symfony\Component\HttpFoundation\JsonResponse;

class GetAdminByEmailController {

    public function __construct(
        private GetAdminServiceInterface $getAdminService
    ) {}

    public function __invoke(string $email)
    {
        try {
            $response = $this->getAdminService->byEmail($email);

            return new JsonResponse($response);
        } catch (Exception $e) {
            throw $e;
        }
        
    }
}