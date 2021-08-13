<?php

return [
    'dsn' => $_ENV['DB_DSN'],
    'user' => $_ENV['DB_USER'],
    'pass' => $_ENV['DB_PASS'],
    'options' => [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_PERSISTENT => true,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES => false
    ]
];