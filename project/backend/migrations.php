<?php

use App\Config\Database;

return [
    'table_storage' => [
        'table_name' => 'doctrine_migration_versions',
        'version_column_name' => 'version',
        'version_column_length' => 191,
        'executed_at_column_name' => 'executed_at',
    ],

    'migrations_paths' => [
        'App\Migrations' => 'database/migrations', // Place where the migrations is saved
    ],

    'all_or_nothing' => true,
    'check_database_platform' => true,
    'check_database_platform' => true,
    'organize_migrations' => 'none',
    'connection' => null,
    'em' => null,
];
