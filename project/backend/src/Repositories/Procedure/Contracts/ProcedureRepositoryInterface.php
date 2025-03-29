<?php

namespace App\Repositories\Procedure\Contracts;

use App\Repositories\BaseRepositoryInterface;
use Doctrine\Common\Collections\Collection;

interface ProcedureRepositoryInterface extends BaseRepositoryInterface
{
    public function getProceduresByIds(array $ids): array;
}