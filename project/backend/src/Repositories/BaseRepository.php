<?php

namespace App\Repositories;

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityRepository;
use stdClass;

abstract class BaseRepository implements BaseRepositoryInterface
{
    private EntityRepository $repository;

    public function __construct(
        private EntityManager $entityManager,
        string $entityClass
    ) {
        $this->repository = $this->entityManager->getRepository($entityClass);
    }

    public function getAll(): array
    {
        return $this->repository->findAll();
    }

    public function findById(int $id): ?stdClass
    {
        return $this->repository->find($id);
    }
    
    public function create(stdClass $model): stdClass
    {
        $this->entityManager->persist($model);

        $this->entityManager->flush();
        
        return $model;
    }
    
    public function update(): bool
    {
        $this->entityManager->flush();

        return true;
    }
    
    public function delete(stdClass $model): bool
    {
        $this->entityManager->remove($model);
        
        $this->entityManager->flush();

        return true;
    }
}