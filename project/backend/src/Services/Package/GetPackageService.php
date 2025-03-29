<?php

namespace App\Services\Package;

use App\Collections\PackageCollection;
use App\Repositories\Package\Contracts\PackageRepositoryInterface;
use App\Services\Package\Contracts\GetPackageServiceInterface;

class GetPackageService implements GetPackageServiceInterface
{
    public function __construct(
        private PackageRepositoryInterface $packageRepository,
        private PackageCollection $packageCollection
    ) {}

    public function getAllPackages(): ?array
    {
        $packages = $this->packageRepository->getAllPackagesWithProcedures();

        if (! $packages) {
            return null;
        }

        return ['packages' => $this->packageCollection->get($packages)];
    }
}