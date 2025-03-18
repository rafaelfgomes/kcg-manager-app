<?php

require __DIR__ . '/vendor/autoload.php';

use Config\Database;
use Config\Kernel;
use Dotenv\Dotenv;

Dotenv::createUnsafeImmutable(rootPath())->load();

$entityManager = Database::getEntityManager();

$kernel = new Kernel($entityManager);

$container = $kernel->getContainer();
