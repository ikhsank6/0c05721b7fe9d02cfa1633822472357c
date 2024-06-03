<?php

use App\Controllers\AuthController;
use App\Controllers\EmailController;
use App\Helpers\Response;
use App\Middleware\JWTMiddleware;
use App\Models\User;
use App\Services\EmailService;

require __DIR__ . '/bootstrap.php';

$dbConfig = include __DIR__ . '/config/database.php';

$dsn = "pgsql:host={$dbConfig['host']};port={$dbConfig['port']};dbname={$dbConfig['database']};";
$pdo = new PDO($dsn, $dbConfig['username'], $dbConfig['password']);

$userModel = new User($pdo);
$authController = new AuthController($userModel);
$emailService = new EmailService();
$emailController = new EmailController($emailService);
$jwtMiddleware = new JWTMiddleware($_ENV['JWT_SECRET']);
$resp = new Response();

$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

if($_SERVER['REQUEST_METHOD'] === 'POST'){
    switch ($uri) {
        case '/register':
            $data = json_decode(file_get_contents('php://input'), true);
            echo $authController->register($data);
            break;
        case '/login':
            $data = json_decode(file_get_contents('php://input'), true);
            echo $authController->login($data);
            break;
        case '/send-email':
            $data = json_decode(file_get_contents('php://input'), true);
            $isValid = $jwtMiddleware->handle();
            if ($isValid) {
                echo $emailController->sendEmail($data);
            } else {
                return $resp->errorResponse('Unauthorized', [], 401);
            }
            break;
        default:
            return $resp->errorResponse('Not Found', [], 404);
            break;
    }
} else {
    return $resp->errorResponse('Not Found', [], 404);
}
