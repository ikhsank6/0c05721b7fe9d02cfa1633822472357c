<?php
namespace App\Migrations;

use PDO;

class EmailTable
{
    private $pdo;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    public function up()
    {
        try {
            // Create Emails table
            $sql = "
        CREATE TABLE emails (
    id SERIAL PRIMARY KEY,
    recipient VARCHAR(255) NOT NULL,
    subject VARCHAR(255) NOT NULL,
    body TEXT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
)
        ";
            $this->pdo->exec($sql);
            echo "Emails table created successfully\n";
        } catch (\Throwable $th) {
            echo "Failed create table Emails .$th->getMessage()\n";
        }
    }

    public function down()
    {
        try {
            // Drop Emails table
            $sql = "DROP TABLE IF EXISTS emails";
            $this->pdo->exec($sql);
            echo "Emails table dropped successfully\n";
        } catch (\Throwable $th) {
            echo "Failed drop table Emails .$th->getMessage()\n";
        }
    }
}
