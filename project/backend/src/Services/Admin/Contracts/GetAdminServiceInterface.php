<?php

namespace App\Services\Admin\Contracts;

interface GetAdminServiceInterface
{
    public function byEmail(string $email): ?array;
}