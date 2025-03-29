<?php

namespace App\Repositories\Package\Contracts;

use App\Entities\Package;
use App\Repositories\BaseRepositoryInterface;
use Doctrine\Common\Collections\ArrayCollection;

interface PackageRepositoryInterface extends BaseRepositoryInterface
{
    public function createNewPackage(Package $package, ArrayCollection $procedures): Package;

    public function getAllPackagesWithProcedures(): array;
}