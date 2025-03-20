<?php

namespace App\Repositories\Admin;

use App\Models\Admin;
use App\Repositories\Admin\Contracts\AdminRepositoryInterface;
use App\Repositories\BaseRepository;
use Doctrine\ORM\EntityManager;

class AdminRepository extends BaseRepository implements AdminRepositoryInterface
{
    public function __construct(
        private EntityManager $entityManager
    ) {
        parent::__construct($entityManager, Admin::class);
    }
}