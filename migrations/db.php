<?php

include_once __DIR__ . '/../vendor/autoload.php';

use Symfony\Component\Dotenv\Dotenv;

$dotenv = new Dotenv();
$dotenv->loadEnv(__DIR__ . '/.env');

// Use $_ENV to avoid errors with dotenv and cli SAPI (getenv doesn't work well)
return [
    'dbname' => $_ENV['MIGRATOR_DB'],
    'user' => $_ENV['MIGRATOR_USER'],
    'password' => $_ENV['MIGRATOR_PASSWORD'],
    'host' => $_ENV['MIGRATOR_HOST'],
    'port' => $_ENV['MIGRATOR_PORT'],
    'driver' => $_ENV['MIGRATOR_DRIVER'],
];