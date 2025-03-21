<?php

namespace App\Repositories;

interface BaseRepositoryInterface
{
    public function getAll(): array;

    public function findById(int $id): ?object;

    public function findByEmail(string $email): ?object;
    
    public function create(object $entity): object;
    
    public function update(): bool;
    
    public function delete(object $entity): bool;
}