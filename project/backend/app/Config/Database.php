<?php

namespace App\Config;

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\ORMSetup;
use Doctrine\DBAL\DriverManager;

class Database {
    public static function getEntityManager(): EntityManager {
        $config = ORMSetup::createAttributeMetadataConfiguration([__DIR__ . "/../Models"], true);

        $connection = DriverManager::getConnection([
            'dbname' => env('DB_NAME'),
            'user' => env('DB_USER'),
            'password' => env('DB_PASS'),
            'host' => env('DB_HOST'),
            'driver' => 'pdo_mysql',
        ], $config);

        return new EntityManager($connection, $config);
    }
}
