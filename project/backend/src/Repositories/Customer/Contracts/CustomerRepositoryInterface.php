<?php

namespace App\Repositories\Customer\Contracts;

use App\Entities\Customer;
use App\Repositories\BaseRepositoryInterface;
use Doctrine\Common\Collections\ArrayCollection;

interface CustomerRepositoryInterface extends BaseRepositoryInterface
{
    public function createNewCustomer(Customer $customer, ArrayCollection $phones): Customer;
}
