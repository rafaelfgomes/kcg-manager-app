<?php

use Doctrine\DBAL\DriverManager;

return DriverManager::getConnection([
    'dbname' => env('DB_MIGRATIONS_NAME'),
    'user' => env('DB_USER'),
    'password' => env('DB_PASS'),
    'host' => env('DB_HOST'),
    'driver' => 'pdo_mysql',
]);
