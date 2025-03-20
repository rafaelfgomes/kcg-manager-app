<?php

namespace App\Services\Customer;

use App\DTO\Customer\CustomerDTO;
use App\Repositories\Customer\Contracts\CustomerRepositoryInterface;
use App\Services\Customer\Contracts\CreateCustomerServiceInterface;

class CreateCustomerService implements CreateCustomerServiceInterface
{
    public function __construct(
        private CustomerRepositoryInterface $customerRepository
    ) {}

    public function execute(array $data): ?array
    {
        $customer = CustomerDTO::fillEntity($data);

        $newCustomer = $this->customerRepository->create($customer);

        if (! $newCustomer) {
            return null;
        }

        return ['message' => 'Cliente ' . $newCustomer->getName() . ' cadastrado com sucesso'];
    }
}