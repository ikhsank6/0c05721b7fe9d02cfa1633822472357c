<?php

namespace App\Models;

use PDO;

class Email
{
    private $db;

    public function __construct(PDO $db)
    {
        $this->db = $db;
    }

    public function create($data)
    {
        date_default_timezone_set('Asia/Jakarta');
        $data = [
            'recipient' =>  $data["to"],
            'subject' =>  $data["subject"],
            'body' =>  $data["body"],
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ];
        
        $stmt = $this->db->prepare("INSERT INTO emails (recipient, subject, body,created_at,updated_at) VALUES (:recipient,:subject, :body, :created_at, :updated_at)");
        return $stmt->execute($data);
    }
}
