<?php

namespace App\Services\Procedure;

use App\DTO\ProcedureDTO;
use App\Repositories\Procedure\Contracts\ProcedureRepositoryInterface;
use App\Services\Procedure\Contracts\CreateProcedureServiceInterface;

class CreateProcedureService implements CreateProcedureServiceInterface
{
    public function __construct(
        private ProcedureRepositoryInterface $procedureRepository,
        private ProcedureDTO $procedureDTO
    ) {}

    public function execute(array $data): ?array
    {
        $procedure = $this->procedureDTO->fillEntity($data);

        $newProcedure = $this->procedureRepository->create($procedure);

        if (! $procedure) {
            return null;
        }

        return ['message' => 'Procedimento ' . $newProcedure->getName() .  ' criado com sucesso'];
    }
}