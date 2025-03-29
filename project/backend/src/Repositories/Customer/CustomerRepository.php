<?php

namespace App\Repositories\Customer;

use App\DTO\Phone\PhoneCollection;
use App\Entities\Customer;
use App\Repositories\BaseRepository;
use App\Repositories\Customer\Contracts\CustomerRepositoryInterface;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\EntityManager;

class CustomerRepository extends BaseRepository implements CustomerRepositoryInterface
{
    public function __construct(
        private EntityManager $entityManager,
    ) {
        parent::__construct($entityManager, Customer::class);
    }

    public function createNewCustomer(Customer $customer, ArrayCollection $phones): Customer
    {
        return $this->entityManager->wrapInTransaction(function () use ($customer, $phones) {
            $this->entityManager->persist($customer);

            foreach ($phones as $phone) {
                $this->entityManager->persist($phone);
            }

            $this->entityManager->flush();

            return $customer;
        });
    }
}