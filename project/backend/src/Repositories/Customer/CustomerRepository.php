<?php

namespace App\Repositories\Customer;

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
            foreach ($phones as $phone) {
                $customer->addPhone($phone);
            }

            $this->entityManager->persist($customer);

            $this->entityManager->flush();

            return $customer;
        });
    }
}