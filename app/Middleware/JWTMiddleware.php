<?php

namespace App\Middleware;

use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use App\Helpers\Response;
use App\Models\User;

class JWTMiddleware
{
    private $secretKey;
    private $userModel;

    public function __construct($secretKey,User $userModel)
    {
        $this->secretKey = $secretKey;
        $this->userModel = $userModel;
    }

    public function handle()
    {
        $header = $_SERVER['HTTP_AUTHORIZATION'] ?? '';

        if (preg_match('/^Bearer\s(\S+)/', $header, $matches)) {
            $token = $matches[1];
            try {
                $decoded = JWT::decode($token, new Key($this->secretKey, 'HS256'));
               
                $user = $this->userModel->findById($decoded->sub);
                if (!$user) {
                    return false;
                }

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
