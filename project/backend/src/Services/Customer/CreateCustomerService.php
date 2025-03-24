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

    public function execute(array &$data): ?array
    {
        $phones = $data['phones'];

        unset($data['phones']);

        $customer = CustomerDTO::fillEntity($data);

        $newCustomer = $this->customerRepository->createNewCustomer($customer, $phones);

        if (! $newCustomer) {
            return null;
        }

        return ['message' => 'Cliente ' . $newCustomer->getName() . ' cadastrado com sucesso'];
    }
}