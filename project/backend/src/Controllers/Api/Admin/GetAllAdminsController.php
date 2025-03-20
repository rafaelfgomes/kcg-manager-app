<?php

namespace App\Controllers\Api\Admin;

use App\Services\Admin\Contracts\GetAllAdminsServiceInterface;
use Exception;
use Symfony\Component\HttpFoundation\JsonResponse;

class GetAllAdminsController {

    public function __construct(
        private GetAllAdminsServiceInterface $getAllAdminsService
    ) {}

    public function __invoke()
    {
        try {
            $admins = $this->getAllAdminsService->execute();

            return new JsonResponse(['admins' => $admins]);
        } catch (Exception $e) {
            throw $e;
        }
        
    }
}