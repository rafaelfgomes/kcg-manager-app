<?php

namespace App\Collections;

use App\DTO\ProcedureDTO;

class ProcedureCollection extends AbstractCollection
{
    public function __construct(ProcedureDTO $procedureDTO)
    {
        parent::__construct($procedureDTO); 
    }
}