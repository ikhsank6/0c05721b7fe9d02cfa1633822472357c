<?php

namespace App\Middleware;

use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use App\Helpers\Response;

class JWTMiddleware
{
    private $secretKey;

    public function __construct($secretKey)
    {
        $this->secretKey = $secretKey;
    }

    public function handle()
    {
        $header = $_SERVER['HTTP_AUTHORIZATION'] ?? '';

        if (preg_match('/^Bearer\s(\S+)/', $header, $matches)) {
            $token = $matches[1];
            try {
                $decoded = JWT::decode($token, new Key($this->secretKey, 'HS256'));
                return true;
            } catch (\Exception $e) {
                return false;
            }
        } else {
            return false;
            // Response::errorResponse('Unauthorized', [], 401);
        }
    }
}
