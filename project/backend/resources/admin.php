<?php

use Carbon\Carbon;
use Dotenv\Dotenv;

Dotenv::createUnsafeImmutable(rootPath())->load();

date_default_timezone_set(env('TIMEZONE'));

return [
    'name' => 'Administrador',
    'email' => 'admin@kcg.com.br',
    'password' => '123456',
    'created_at' => Carbon::now()->toDateTimeString(),
];