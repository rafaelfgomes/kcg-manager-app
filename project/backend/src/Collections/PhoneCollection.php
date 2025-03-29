<?php

namespace App\Collections;

use App\DTO\PhoneDTO;
use App\Entities\Customer;
use Doctrine\Common\Collections\ArrayCollection;

class PhoneCollection
{
    public function __construct(private PhoneDTO $phoneDTO)
    {
    }

    public function get(array $phones, Customer $customer): ArrayCollection
    {
        $phoneCollection = new ArrayCollection();

        foreach ($phones as $phone) {
            $phoneCollection->add($this->phoneDTO->fillEntity($phone, $customer));
        }

        return $phoneCollection;
    }
}