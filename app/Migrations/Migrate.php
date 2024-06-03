<?php

use App\Migrations\EmailTable;
use App\Migrations\UsersTable;

require __DIR__ . '/../../bootstrap.php';
$dbConfig = include __DIR__ . '/../../config/database.php';

$dsn = "pgsql:host={$dbConfig['host']};port={$dbConfig['port']};dbname={$dbConfig['database']};";
$pdo = new PDO($dsn, $dbConfig['username'], $dbConfig['password']);

$userMigration = new UsersTable($pdo);
$emailsMigration = new EmailTable($pdo);

$userMigration->up();
$emailsMigration->up();