<?php

namespace App\Services\User\Contracts;

interface GetUserByEmailServiceInterface
{
    public function execute(string $email): ?array;
}