<?php

namespace App\Collections;

use App\DTO\CustomerDTO;

class CustomerCollection extends AbstractCollection
{
    public function __construct(CustomerDTO $customerDTO)
    {
        parent::__construct($customerDTO);    
    }
}