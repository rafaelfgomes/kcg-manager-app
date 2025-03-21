<?php

namespace App\DTO\Customer;

use App\DTO\Phone\PhoneDTO;
use App\Entities\Customer;

class CustomerDTO
{
    public function __construct(
        public readonly ?int $id,
        public readonly string $name,
        public readonly string $email,
        public readonly iterable $phones
    ) {
    }

    public static function fillDatafromEntity(Customer $customer): array
    {
        $phones = [];

        foreach ($customer->getPhones() as $phone) {
            if (empty($phone)) {
                continue;
            }

            array_push($phones, PhoneDTO::fullPhoneNumber($phone));
        }

        return (array) new self(
            id: $customer->getId(),
            name: $customer->getName(),
            email: $customer->getEmail(),
            phones: $phones
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
