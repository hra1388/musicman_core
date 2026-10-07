<?php

return [
    'mysql' => [
        'host' => $_ENV['DB_HOST'] ?? 'localhost',
        'port' => (int)($_ENV['DB_PORT'] ?? 3306),
        'dbname' => $_ENV['DB_NAME'] ?? '',
        'user' => $_ENV['DB_USER'] ?? '',
        'pass' => $_ENV['DB_PASS'] ?? '',
        'charset' => 'utf8mb4',
        'collation' => 'utf8mb4_general_ci',
        'persistent' => true,
        'timeout' => 5,
        'max_retries' => 2,
    ],
    'sqlite' => [
        'file' => $_ENV['SQLITE_DB_FILE'] ?? __DIR__ . '/../download_queue.sqlite',
        'timeout' => 5,
    ]
];
