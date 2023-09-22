<?php

/**
 * @school ENSITECH
 * @company H2V Solutions
 * @created_at 2023-09-22 00:06:53
 * @updated_by Rudy GAULT
 * @updated_at 2023-09-22 00:06:53
 */
require 'vendor/autoload.php';
$dotenv = \Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();
 
 $dbHost = $_ENV['DB_HOST'];
 $dbUser = $_ENV['DB_USER'];
 $dbPass = $_ENV['DB_PASS'];
 $dbName = $_ENV['DB_NAME'];
 