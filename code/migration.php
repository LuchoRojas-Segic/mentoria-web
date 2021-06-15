<?php

require_once __DIR__.'/vendor/autoload.php';

use app\core\Application;

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

$config = [
    'db' => [
        'dsn' => $_ENV['DSN'],
        'user' => $_ENV['USERNAME'],
        'password' => $_ENV['PASSWORD'],
    ]
 ];

$app = new Application(__DIR__, $config);   
$app->db->applyMigrations();