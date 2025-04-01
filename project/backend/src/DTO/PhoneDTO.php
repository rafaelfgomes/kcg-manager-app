<?php

namespace App\DTO;

use App\Entities\Customer;
use App\Entities\Phone;
use App\Support\PhoneNumber;

class PhoneDTO
{
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