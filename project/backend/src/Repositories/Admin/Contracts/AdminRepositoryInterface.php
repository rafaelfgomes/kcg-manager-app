<?php

namespace App\Repositories\Admin\Contracts;

use App\Models\Admin;
use App\Models\User;
use App\Repositories\BaseRepositoryInterface;

interface AdminRepositoryInterface extends BaseRepositoryInterface
{
    public function createNewAdmin(User $user, string $password): Admin;
}
