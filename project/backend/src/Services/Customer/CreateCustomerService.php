<?php

namespace App\Services\Customer;

use App\DTO\Customer\CustomerDTO;
use App\DTO\Phone\PhoneCollection;
use App\DTO\Phone\PhoneDTO;
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
        
        //dd($customer);

        // foreach ($phones as $phone) {
        //     dd($phone);
        //     $phone['customer'] = $customer;

        //     $newPhone = PhoneDTO::fillEntity($phone);

        //     array_push($customer->getPhones(), $newPhone);
        // }

        // dd($customer);

        $newCustomer = $this->customerRepository->createNewCustomer($customer, $phones);

        if (! $newCustomer) {
            return null;
        }

        return ['message' => 'Cliente ' . $newCustomer->getName() . ' cadastrado com sucesso'];
    }
}