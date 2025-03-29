<?php

namespace App\Collections;

use App\DTO\PackageDTO;

class PackageCollection extends AbstractCollection
{
    public function __construct(PackageDTO $packageDTO)
    {
        parent::__construct($packageDTO);    
    }
}