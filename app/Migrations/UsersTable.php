<?php
namespace App\Migrations;

use PDO;

class UsersTable
{
    private $pdo;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    public function up()
    {
        try {
            // Create users table
            $sql = "
        CREATE TABLE users (
            id SERIAL PRIMARY KEY,
            name VARCHAR(50) NOT NULL,
            email VARCHAR(100) NOT NULL,
            password VARCHAR(255) NOT NULL,
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
            updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
        )
        ";
            $this->pdo->exec($sql);
            echo "Users table created successfully\n";
        } catch (\Throwable $th) {
            echo "Failed create table Users .$th->getMessage()\n";
        }
    }

    public function down()
    {
        try {
            // Drop users table
            $sql = "DROP TABLE IF EXISTS users";
            $this->pdo->exec($sql);
            echo "Users table dropped successfully\n";
        } catch (\Throwable $th) {
            echo "Failed drop table Users .$th->getMessage()\n";
        }
    }
}
