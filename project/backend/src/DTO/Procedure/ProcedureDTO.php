<?php

namespace App\DTO\Procedure;

use App\Entities\Procedure;

class ProcedureDTO
{
    public function __construct(
        public readonly ?int $id,
        public readonly int $name,
        public readonly int $price
    ) {}

    public static function fillDatafromEntity(Procedure $procedure): array
    {
        $adminDTO = new self(
            id: $procedure->getId(),
            name: $procedure->getName(),
            price: $procedure->getPrice()
        );

        return (array) $adminDTO;
    }

    public static function fillEntity(array $data): Procedure
    {
        return new Procedure(
            name: $data['name'],
            price: $data['price'],
            id: $data['id'] ?? null
        );
    }
}