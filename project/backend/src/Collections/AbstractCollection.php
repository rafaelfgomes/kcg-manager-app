<?php

namespace App\Collections;

use App\DTO\DTOInterface;

abstract class AbstractCollection
{
    public function __construct(private DTOInterface $dto)
    {}

    public function get(array $values): array
    {
        return array_map(function ($value) {
            return $this->dto->fillDatafromEntity($value);
        }, $values);
    }
}