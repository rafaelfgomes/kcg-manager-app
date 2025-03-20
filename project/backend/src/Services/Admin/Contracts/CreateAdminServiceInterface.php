<?php

namespace App\Services\Admin\Contracts;

interface CreateAdminServiceInterface
{
    public function execute(array &$data): ?array;
}