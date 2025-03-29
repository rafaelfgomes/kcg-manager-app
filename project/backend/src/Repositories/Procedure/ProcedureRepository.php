<?php

namespace App\Repositories\Procedure;

use App\Entities\Procedure;
use App\Repositories\BaseRepository;
use App\Repositories\Procedure\Contracts\ProcedureRepositoryInterface;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\EntityManager;

class ProcedureRepository extends BaseRepository implements ProcedureRepositoryInterface
{
    public function __construct(
        private EntityManager $entityManager
    ) {
        parent::__construct($entityManager, Procedure::class);
    }

    public function getProceduresByIds(array $ids): array
    {
        return $this->entityManager
            ->createQueryBuilder()
            ->select('p')
            ->from(Procedure::class, 'p')
            ->where('p.id IN (:ids)')
            ->setParameter('ids', $ids)
            ->getQuery()
            ->getResult();
    }
}