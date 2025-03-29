<?php

namespace App\DTO;

use App\Entities\Customer;
use App\Entities\Phone;

class PhoneDTO
{
    public function __construct(
        public readonly ?int $id = null,
        public readonly ?int $country = null,
        public readonly ?int $local = null,
        public readonly ?string $number = null,
    ) {}

    public function fillEntity(array $data, Customer $customer): object
    {
        return new Phone(
            country: $data['country'],
            code: $data['code'] ?? null,
            number: $data['number'],
            customer: $customer,
            id: $data['id'] ?? null
        );
    }
}