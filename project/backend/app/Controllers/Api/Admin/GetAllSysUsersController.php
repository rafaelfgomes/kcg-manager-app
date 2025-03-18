<?php

namespace App\Controllers\Api\SysUsers;

use Symfony\Component\HttpFoundation\JsonResponse;

class GetAllSysUsersController {

    public function __construct() {
    }

    public function __invoke()
    {
        $users = [['nome' => 'Teste'], ['nome' => 'Teste2']];

        return new JsonResponse(['users' => $users]);
    }
}