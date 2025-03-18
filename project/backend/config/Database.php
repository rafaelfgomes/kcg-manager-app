<?php

namespace Config;

use Doctrine\ORM\EntityManager;
use Doctrine\DBAL\DriverManager;
use Doctrine\ORM\ORMSetup;

class Database {
    public static function getEntityManager(): EntityManager {
        $isDevMode = (env('APP_ENV') === 'local') ? true : false;

        $connectionParams = require_once rootPath() . '/database/config.php';

        $config = ORMSetup::createAttributeMetadataConfiguration([rootPath() . '/app/Models'], $isDevMode);

        $connection = DriverManager::getConnection($connectionParams, $config);

        return new EntityManager($connection, $config);
    }
}
