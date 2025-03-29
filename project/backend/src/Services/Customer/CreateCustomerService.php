<?php

namespace App\Services\Customer;

use App\Collections\PhoneCollection;
use App\DTO\CustomerDTO;
use App\Repositories\Customer\Contracts\CustomerRepositoryInterface;
use App\Services\Customer\Contracts\CreateCustomerServiceInterface;

class CreateCustomerService implements CreateCustomerServiceInterface
{
    public function __construct(
        private CustomerRepositoryInterface $customerRepository,
        private CustomerDTO $customerDTO,
        private PhoneCollection $phoneCollection
    ) {}

    public function execute(array $data): ?array
    {
        $phones = $data['phones'];

        unset($data['phones']);

        $customer = $this->customerDTO->fillEntity($data);

        $phones = $this->phoneCollection->get($phones, $customer);

        $newCustomer = $this->customerRepository->createNewCustomer($customer, $phones);

        if (! $newCustomer) {
            return null;
        }

        return ['message' => 'Cliente ' . $newCustomer->getName() . ' cadastrado com sucesso'];
    }
}