<?php

require __DIR__ . '/bootstrap.php';

use App\Models\Email;
use App\Services\EmailService;
use App\Services\Mailer;

$dbConfig = include __DIR__ . '/config/database.php';

$dsn = "pgsql:host={$dbConfig['host']};port={$dbConfig['port']};dbname={$dbConfig['database']};";
$pdo = new PDO($dsn, $dbConfig['username'], $dbConfig['password']);

$emailModel = new Email($pdo);

$rabbitmq = new EmailService();

$callback = function ($msg) use ($emailModel) {
    $data = json_decode($msg->body, true);

    $mailer = new Mailer();
    try {
        $mailer->send($data['to'], $data['subject'], $data['body']);
        $emailModel->create($data);
        echo "Email sent to {$data['to']}\n";
    } catch (Exception $e) {
        echo "Failed to send email: " . $e->getMessage() . "\n";
    }
};

$rabbitmq->consume($callback);