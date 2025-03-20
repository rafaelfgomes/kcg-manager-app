<?php

namespace App\Services\Admin\Contracts;

interface GetAllAdminsServiceInterface
{
    public function execute(): ?array;
}