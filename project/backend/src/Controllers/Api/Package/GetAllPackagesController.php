<?php

namespace App\Controllers\Api\Package;

use App\Services\Package\Contracts\GetPackageServiceInterface;
use Exception;
use Symfony\Component\HttpFoundation\JsonResponse;

class GetAllPackagesController
{
    public function __construct(
        private GetPackageServiceInterface $getPackageService
    ) {}

    public function __invoke()
    {
        try {
            $response = $this->getPackageService->getAllPackages();

            return new JsonResponse($response);
        } catch (Exception $e) {
            throw $e;
        }
    }
}