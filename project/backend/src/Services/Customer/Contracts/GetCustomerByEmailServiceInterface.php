<?php

namespace App\Services\Customer\Contracts;

interface GetCustomerByEmailServiceInterface
{
    public function execute(string $email): ?array;
}