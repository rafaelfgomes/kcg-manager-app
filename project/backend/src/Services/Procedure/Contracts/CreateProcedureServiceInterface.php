<?php

namespace App\Services\Procedure\Contracts;

interface CreateProcedureServiceInterface
{
    public function execute(array $data): ?array;
}