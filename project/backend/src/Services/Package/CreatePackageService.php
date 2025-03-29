<?php

namespace App\Services\Package;

use App\DTO\PackageDTO;
use App\Repositories\Package\Contracts\PackageRepositoryInterface;
use App\Repositories\Procedure\Contracts\ProcedureRepositoryInterface;
use App\Services\Package\Contracts\CreatePackageServiceInterface;
use Doctrine\Common\Collections\ArrayCollection;

class CreatePackageService implements CreatePackageServiceInterface
{
    public function __construct(
        private PackageRepositoryInterface $packageRepository,
        private ProcedureRepositoryInterface $procedureRepository,
        private PackageDTO $packageDTO,
    ) {}

    public function execute(array $data): ?array
    {
        $proceduresIds = $data['procedures'];

        unset($data['procedures']);

        $procedures = $this->procedureRepository->getProceduresByIds($proceduresIds);

        $package = $this->packageDTO->fillEntity($data);

        $newPackage = $this->packageRepository->createNewPackage($package, new ArrayCollection($procedures));

        if (! $newPackage) {
            return null;
        }

        return ['message' => 'Pacote ' . $newPackage->getName() . ' cadastrado com sucesso'];
    }
}