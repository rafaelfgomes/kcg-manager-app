<?php

declare(strict_types=1);

require __DIR__ . '/vendor/autoload.php';

spl_autoload_register(function ($class) {
    $file = rootPath() . '/src/' . str_replace('\\', '/', $class) . '.php';

    if (file_exists($file)) {
        require_once $file;
    }
});

