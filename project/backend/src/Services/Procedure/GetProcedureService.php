<?php

namespace App\Services\Procedure;

use App\Collections\ProcedureCollection;
use App\Repositories\Procedure\Contracts\ProcedureRepositoryInterface;
use App\Services\Procedure\Contracts\GetProcedureServiceInterface;

class GetProcedureService implements GetProcedureServiceInterface
{
    public function __construct(
        private ProcedureRepositoryInterface $procedureRepository,
        private ProcedureCollection $procedureCollection
    ) {}

    public function all(): ?array
    {
        $procedures = $this->procedureRepository->getAll();

        if (! $procedures) {
            return null;
        }

        return ['procedures' => $this->procedureCollection->get($procedures)];
    }
}