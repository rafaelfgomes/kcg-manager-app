<?php

namespace App\Services\Customer\Contracts;

interface GetCustomerServiceInterface
{
    public function all(): ?array;

    public function byEmail(string $email): ?array;
}