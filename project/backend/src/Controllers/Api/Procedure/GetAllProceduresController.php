<?php

namespace App\Controllers\Api\Procedure;

use App\Services\Procedure\Contracts\GetProcedureServiceInterface;
use Exception;
use Symfony\Component\HttpFoundation\JsonResponse;

class GetAllProceduresController
{
    public function __construct(
        private GetProcedureServiceInterface $getProcedureService
    ) {}

    public function __invoke()
    {
        try {
            $response = $this->getProcedureService->all();

            return new JsonResponse($response);
        } catch (Exception $e) {
            throw $e;
        }
    }
}