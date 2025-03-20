<?php

namespace App\DTO\Customer;

class CustomerCollection
{
    public static function get(array $customers): array
    {
        return array_map(function ($customer){
            return CustomerDTO::fillDatafromEntity($customer);
        }, $customers);
    }
}