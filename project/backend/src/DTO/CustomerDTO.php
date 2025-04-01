<?php

namespace App\DTO;

use App\Entities\Customer;
use App\Support\PhoneNumber;

class CustomerDTO implements DTOInterface
{
    public function __construct(
        public readonly ?int $id = null,
        public readonly ?string $name = null,
        public readonly ?string $email = null,
        public readonly ?iterable $phones = null,
    ) {
    }

    public function fillDatafromEntity(object $customer): array
    {
        $phones = [];

        foreach ($customer->getPhones() as $phone) {
            if (empty($phone)) {
                continue;
            }

            $phoneArray = [
                'id' => $phone->getId(),
                'number' => PhoneNumber::full($phone),
                'is_main_phone' => $phone->getMainNumber(),
            ];

            array_push($phones, $phoneArray);
        }

        return (array) new self(
            id: $customer->getId(),
            name: $customer->getName(),
            email: $customer->getEmail(),
            phones: $phones
        );
    }

    public function fillEntity(array $data): object
    {
        return new Customer(
            name: $data['name'],
            email: $data['email'],
            id: $data['id'] ?? null
        );
    }
}
