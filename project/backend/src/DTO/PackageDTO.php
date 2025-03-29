<?php

namespace App\DTO;

use App\Entities\Package;

class PackageDTO implements DTOInterface
{
    public function __construct(
        public readonly ?int $id = null,
        public readonly ?string $name = null,
        public readonly ?int $sessions = null,
        public readonly ?int $price = null,
    ) {}

    public function fillDatafromEntity(object $package): array
    {
        $packageDTO = new self(
            id: $package->getId(),
            name: $package->getName(),
            sessions: $package->getSessions(),
            price: $package->getPrice()
        );

        return (array) $packageDTO;
    }

    public function fillEntity(array $data): object
    {
        return new Package(
            name: $data['name'],
            sessions: $data['sessions'],
            price: $data['price'],
            id: $data['id'] ?? null
        );
    }
}