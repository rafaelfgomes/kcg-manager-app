<?php

namespace App\Repositories\Customer\Contracts;

use App\Entities\Customer;
use App\Repositories\BaseRepositoryInterface;

interface CustomerRepositoryInterface extends BaseRepositoryInterface
{
    public function createNewCustomer(Customer $customer, array $phones): Customer;
}
