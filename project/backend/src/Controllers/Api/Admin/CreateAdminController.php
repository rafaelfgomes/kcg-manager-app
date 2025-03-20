<?php

namespace App\Controllers\Api\Admin;

use App\Services\Admin\Contracts\CreateAdminServiceInterface;
use Exception;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class CreateAdminController {

    public function __construct(
        private CreateAdminServiceInterface $createAdminService
    ) {}

    public function __invoke(Request $request)
    {
        try {
            $data = json_decode($request->getContent(), true);

            $response = $this->createAdminService->execute($data);

            return new JsonResponse($response, Response::HTTP_CREATED);
        } catch (Exception $e) {
            throw $e;
        }
        
    }
}