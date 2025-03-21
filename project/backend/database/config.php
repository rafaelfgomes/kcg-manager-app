<?php

use Doctrine\DBAL\DriverManager;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\ORMSetup;

$config = ORMSetup::createAttributeMetadataConfiguration(
    paths: [rootPath() . '/src/Models'],
    isDevMode: true
);

$connectionParams = [
    'dbname' => env('DB_NAME'),
    'user' => env('DB_USER'),
    'password' => env('DB_PASS'),
    'host' => env('DB_HOST'),
    'driver' => 'pdo_mysql',
];

$connection = DriverManager::getConnection($connectionParams, $config);

return new EntityManager($connection, $config);
