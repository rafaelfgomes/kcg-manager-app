<?php

namespace Database;

use Doctrine\DBAL\DriverManager;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\ORMSetup;

class DatabaseEntityManager
{
    public static function create(): EntityManager
    {
        $config = ORMSetup::createAttributeMetadataConfiguration(
            paths: [rootPath() . '/src/Entites'],
            isDevMode: true
        );

        $connection = DriverManager::getConnection(DatabaseParams::getValues(), $config);

        return new EntityManager($connection, $config);
    }
}