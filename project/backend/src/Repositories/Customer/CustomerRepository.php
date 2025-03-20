<?php

namespace App\Repositories\Customer;

use App\Models\Customer;
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
}