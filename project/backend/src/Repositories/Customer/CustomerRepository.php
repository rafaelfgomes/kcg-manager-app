<?php

namespace App\Repositories\Customer;

use App\DTO\Phone\PhoneCollection;
use App\Entities\Customer;
use App\Repositories\BaseRepository;
use App\Repositories\Customer\Contracts\CustomerRepositoryInterface;
use Doctrine\ORM\EntityManager;

class CustomerRepository extends BaseRepository implements CustomerRepositoryInterface
{
    public function __construct(
        private EntityManager $entityManager
    ) {
        parent::__construct($entityManager, Customer::class);
    }

    public function createNewCustomer(Customer $customer, array $phones): Customer
    {
        return $this->entityManager->wrapInTransaction(function () use ($customer, $phones) {
            $this->entityManager->persist($customer);

            $phoneCollection = PhoneCollection::get($phones, $customer);

            foreach ($phoneCollection as $phone) {
                $this->entityManager->persist($phone);
            }

            $this->entityManager->flush();

            return $customer;
        });
    }
}