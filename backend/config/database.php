<?php

return [
    'default' => env('DB_CONNECTION', 'pgsql'),
    'connections' => [
        'pgsql' => [
            'driver' => 'pgsql',
            'host' => env('DB_HOST', '127.0.0.1'),
            'port' => env('DB_PORT', '5432'),
            'database' => env('DB_DATABASE', 'pmo'),
            'username' => env('DB_USERNAME', 'pmo'),
            'password' => env('DB_PASSWORD', 'pmo'),
        ],
    ],
];
