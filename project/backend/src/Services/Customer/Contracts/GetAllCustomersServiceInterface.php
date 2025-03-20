<?php

namespace App\Services\Customer\Contracts;

interface GetAllCustomersServiceInterface
{
    public function execute(): ?array;
}