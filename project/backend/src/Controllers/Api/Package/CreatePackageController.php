<?php

namespace App\Controllers\Api\Package;

use App\Services\Package\Contracts\CreatePackageServiceInterface;
use Exception;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class CreatePackageController
{
    public function __construct(
        private CreatePackageServiceInterface $createPackageService
    ) {}

    public function __invoke(Request $request): JsonResponse
    {
        try {
            $data = json_decode($request->getContent(), true);

            $response = $this->createPackageService->execute($data);

            return new JsonResponse($response);
        } catch (Exception $e) {
            throw $e;
        }
    }
}