<?php

namespace App\Controllers\Api\Procedure;

use App\Services\Procedure\Contracts\CreateProcedureServiceInterface;
use Exception;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class CreateProcedureController
{
    public function __construct(
        private CreateProcedureServiceInterface $createProcedureService
    ) {}

    public function __invoke(Request $request)
    {
        try {
            $data = json_decode($request->getContent(), true);

            $response = $this->createProcedureService->execute($data);

            return new JsonResponse($response, Response::HTTP_CREATED);
        } catch (Exception $e) {
            throw $e;
        }
    }
}