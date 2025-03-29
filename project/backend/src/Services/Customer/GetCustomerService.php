<?php

namespace App\Services\Customer;

use App\Collections\CustomerCollection;
use App\DTO\CustomerDTO;
use App\Repositories\Customer\Contracts\CustomerRepositoryInterface;
use App\Services\Customer\Contracts\GetCustomerServiceInterface;

class GetCustomerService implements GetCustomerServiceInterface
{
    public function __construct(
        private CustomerRepositoryInterface $customerRepository,
        private CustomerCollection $customerCollection,
        private CustomerDTO $customerDTO
    ) {}
    
    public function all(): ?array
    {
        $customers = $this->customerRepository->getAll();

        if (! $customers) {
            return null;
        }

        return ['customers' => $this->customerCollection->get($customers)] ;
    }

    public function byEmail(string $email): ?array
    {
        $customer = $this->customerRepository->findByEmail($email);

        if (! $customer) {
            return null;
        }

        return ['customer' => $this->customerDTO->fillDatafromEntity($customer)] ;
    }
}