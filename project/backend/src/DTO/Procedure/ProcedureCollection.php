<?php

namespace App\DTO\Customer;

use App\DTO\Procedure\ProcedureDTO;

class ProcedureCollection
{
    public static function get(array $procedures): array
    {
        return array_map(function ($procedure){
            return ProcedureDTO::fillDatafromEntity($procedure);
        }, $procedures);
    }
}