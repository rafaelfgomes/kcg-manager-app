<?php

namespace App\DTO\Phone;

use App\Entities\Customer;
use Doctrine\Common\Collections\ArrayCollection;

class PhoneCollection
{
    public static function get(array $phones, Customer $customer): ArrayCollection
    {
        $phoneCollection = new ArrayCollection();

        foreach ($phones as $phone) {
            $phoneCollection->add(PhoneDTO::fillEntity($phone, $customer));
        }

        return $phoneCollection;
    }
}