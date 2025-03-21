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
        return $this->repository->findBy(['deletedAt' => null]);
    }

    public function getAllWithDeleted(): array
    {
        return $this->repository->findAll();
    }

    public function findById(int $id): ?object
    {
        return $this->repository->find($id);
    }

    public function findByEmail(string $email): ?object {
        return $this->repository->findOneBy(['email' => $email]);
    }
    
    public function create(object $entity): object
    {
        $this->entityManager->persist($entity);

        $this->entityManager->flush();

        return $entity;
    }

    public function createWithoutFlush(object $entity): object
    {
        $this->entityManager->persist($entity);
        
        return $entity;
    }
    
    public function update(): bool
    {
        $this->entityManager->flush();

        return true;
    }
    
    public function delete(object $entity): bool
    {
        $this->entityManager->remove($entity);
        
        $this->entityManager->flush();

        return true;
    }
}