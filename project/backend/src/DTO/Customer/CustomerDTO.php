<?php

namespace App\DTO\Customer;

use App\Models\Customer;

class CustomerDTO
{
    public function __construct(
        public readonly ?int $id,
        public readonly string $name,
        public readonly string $email
    ) {
    }

    public static function fillDatafromEntity(Customer $customer): array
    {
        return (array) new self(
            id: $customer->getId(),
            name: $customer->getName(),
            email: $customer->getEmail()
        );
    }

    public static function fillEntity(array $data): Customer
    {
        return new Customer(
            name: $data['name'],
            email: $data['email'],
            id: $data['id'] ?? null
        );
    }
}
