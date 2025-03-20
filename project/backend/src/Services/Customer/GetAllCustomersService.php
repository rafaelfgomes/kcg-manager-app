<?php

namespace App\Services\Customer;

use App\DTO\Customer\CustomerCollection;
use App\Repositories\Customer\Contracts\CustomerRepositoryInterface;
use App\Services\Customer\Contracts\GetAllCustomersServiceInterface;

class GetAllCustomersService implements GetAllCustomersServiceInterface
{
    public function __construct(
        private CustomerRepositoryInterface $customerRepository
    ) {    
    }

    public function execute(): ?array
    {
        $customers = $this->customerRepository->getAll();

        if (! $customers) {
            return null;
        }

        return ['customers' => CustomerCollection::get($customers)] ;
    }
}