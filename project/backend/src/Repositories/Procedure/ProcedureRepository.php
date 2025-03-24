<?php

namespace App\Repositories\Procedure;

use App\Entities\Procedure;
use App\Repositories\BaseRepository;
use App\Repositories\Procedure\Contracts\ProcedureRepositoryInterface;
use Doctrine\ORM\EntityManager;

class ProcedureRepository extends BaseRepository implements ProcedureRepositoryInterface
{
    public function __construct(
        private EntityManager $entityManager
    ) {
        parent::__construct($entityManager, Procedure::class);
    }
}