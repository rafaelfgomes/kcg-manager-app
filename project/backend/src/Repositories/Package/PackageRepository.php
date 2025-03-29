<?php

namespace App\Repositories\Package;

use App\Entities\Package;
use App\Repositories\BaseRepository;
use App\Repositories\Package\Contracts\PackageRepositoryInterface;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\EntityManager;

class PackageRepository extends BaseRepository implements PackageRepositoryInterface
{
    public function __construct(
        private EntityManager $entityManager
    ) {
        parent::__construct($entityManager, Package::class);
    }

    public function getAllPackagesWithProcedures(): array
    {
        return $this->entityManager->createQueryBuilder()
            ->select('pack, proc')
            ->from(Package::class, 'pack')
            ->leftJoin('pack.procedures', 'proc')
            ->getQuery()
            ->getResult();
    }

    public function createNewPackage(Package $package, ArrayCollection $procedures): Package
    {
        return $this->entityManager->wrapInTransaction(function () use ($package, $procedures) {
            foreach ($procedures as $procedure) {
                $package->addProcedure($procedure);
            }

            $this->entityManager->persist($package);

            $this->entityManager->flush();

            return $package;
        });
    }
}