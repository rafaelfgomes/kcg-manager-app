<?php

namespace App\Repositories;

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityRepository;

abstract class BaseRepository implements BaseRepositoryInterface
{
    protected EntityRepository $repository;

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

    public function findById(int $id): ?object
    {
        return $this->repository->find($id);
    }
    
    public function create(object $model): object
    {
        $this->entityManager->persist($model);

        $this->entityManager->flush();

        return $model;
    }

    public function createWithoutFlush(object $model): object
    {
        $this->entityManager->persist($model);
        
        return $model;
    }
    
    public function update(): bool
    {
        $this->entityManager->flush();

        return true;
    }
    
    public function delete(object $model): bool
    {
        $this->entityManager->remove($model);
        
        $this->entityManager->flush();

        return true;
    }
}