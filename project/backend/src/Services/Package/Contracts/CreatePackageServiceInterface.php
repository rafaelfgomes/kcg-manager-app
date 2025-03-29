<?php

namespace App\Services\Package\Contracts;

interface CreatePackageServiceInterface
{
    public function execute(array $data): ?array;
}