<?php

namespace App\Services\Customer;

use App\DTO\Customer\CustomerDTO;
use App\Repositories\Customer\Contracts\CustomerRepositoryInterface;
use App\Services\Customer\Contracts\GetCustomerByEmailServiceInterface;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class GetCustomerByEmailService implements GetCustomerByEmailServiceInterface
{
    public function __construct(
        private CustomerRepositoryInterface $customerRepository
    ) {}

    public function execute(string $email): ?array
    {
        $customer = $this->customerRepository->findByEmail($email);

        if (! $customer) {
            throw new NotFoundHttpException('Usuário não encontrado');
        }

        return ['customer' => CustomerDTO::fillDatafromEntity($customer)] ;
    }
}