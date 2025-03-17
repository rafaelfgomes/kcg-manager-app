<?php

namespace App\Controllers\Api\SysUsers;

use stdClass;
use Symfony\Component\HttpFoundation\JsonResponse;

class GetAllClientsController
{
    public function __construct(
        private stdClass $getAllClientsService
    ) {
    }

    public function __invoke()
    {
        $clients = [['nome' => 'Teste'], ['nome' => 'Teste2']];

        return new JsonResponse(['clients' => $clients]);
    }
}