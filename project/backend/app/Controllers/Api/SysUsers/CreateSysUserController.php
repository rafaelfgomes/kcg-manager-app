<?php

namespace App\Controllers\Api\SysUsers;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class CreateSysUserController {

    public function __construct() {
    }

    public function __invoke()
    {
        $users = [['nome' => 'AATeste'], ['nome' => 'Teste2']];

        return new JsonResponse(['users' => $users], Response::HTTP_CREATED);
    }
}