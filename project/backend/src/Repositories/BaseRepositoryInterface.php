<?php

namespace App\Repositories;

use stdClass;

interface BaseRepositoryInterface
{
    public function getAll(): array;

    public function findById(int $id): ?stdClass;
    
    public function create(stdClass $model): stdClass;
    
    public function update(): bool;
    
    public function delete(stdClass $model): bool;
}