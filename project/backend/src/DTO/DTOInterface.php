<?php

namespace App\DTO;

interface DTOInterface
{
    public function fillDatafromEntity(object $entity): array;

    public function fillEntity(array $data): object;
}