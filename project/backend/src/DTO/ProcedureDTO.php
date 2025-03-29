<?php

namespace App\DTO;

use App\Entities\Procedure;
use App\Support\Price;

class ProcedureDTO implements DTOInterface
{
    public function __construct(
        public readonly ?int $id = null,
        public readonly ?string $name = null,
        public readonly ?string $price = null,
    ) {}

    public function fillDatafromEntity(object $procedure): array
    {
        $procedureDTO = new self(
            id: $procedure->getId(),
            name: $procedure->getName(),
            price: Price::convertToString($procedure->getPrice())
        );

        return (array) $procedureDTO;
    }

    public function fillEntity(array $data): object
    {
        return new Procedure(
            name: $data['name'],
            price: $data['price'],
            id: $data['id'] ?? null
        );
    }
}