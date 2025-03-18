<?php

namespace App\Services\User\Contracts;

interface GetAllUsersServiceInterface
{
    public function listAllUsers(): array;
}