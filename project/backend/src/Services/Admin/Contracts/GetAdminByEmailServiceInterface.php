<?php

namespace App\Services\Admin\Contracts;

interface GetAdminByEmailServiceInterface
{
    public function execute(string $email): ?array;
}