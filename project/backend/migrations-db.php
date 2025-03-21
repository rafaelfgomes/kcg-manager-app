<?php

use Database\DatabaseParams;
use Doctrine\DBAL\DriverManager;
use Dotenv\Dotenv;

Dotenv::createUnsafeImmutable(rootPath())->load();

return DriverManager::getConnection(DatabaseParams::getValues());
