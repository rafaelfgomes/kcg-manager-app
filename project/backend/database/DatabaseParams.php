<?php

namespace Database;

class DatabaseParams
{
    public static function getValues()
    {
        return [
            'dbname' => env('DB_NAME'),
            'user' => env('DB_USER'),
            'password' => env('DB_PASS'),
            'host' => env('DB_HOST'),
            'port' => env('DB_PORT'),
            'driver' => 'pdo_mysql',
        ];
    }
}
