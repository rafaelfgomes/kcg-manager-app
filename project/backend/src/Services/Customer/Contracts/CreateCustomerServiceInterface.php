<?php

namespace App\Services\Customer\Contracts;

interface CreateCustomerServiceInterface
{
    public function execute(array $data): ?array;
}