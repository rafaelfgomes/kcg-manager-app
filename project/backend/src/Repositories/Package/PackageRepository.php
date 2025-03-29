<?php

namespace App\Repositories\Package;

use App\Entities\Package;
use App\Repositories\BaseRepository;
use App\Repositories\Package\Contracts\PackageRepositoryInterface;
use Doctrine\ORM\EntityManager;

class PackageRepository extends BaseRepository implements PackageRepositoryInterface
{
    public function __construct(
        private EntityManager $entityManager
    ) {
        parent::__construct($entityManager, Package::class);
    }
}