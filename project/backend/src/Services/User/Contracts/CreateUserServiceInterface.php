<?php

namespace App\Services\User\Contracts;

interface CreateUserServiceInterface
{
    public function execute(array $data): ?array;
}