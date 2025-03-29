<?php

namespace App\Services\Package\Contracts;

interface GetPackageServiceInterface
{
    public function all(): ?array;
}