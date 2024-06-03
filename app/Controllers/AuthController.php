<?php

namespace App\Controllers;

use App\Models\User;
use App\Helpers\Response;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;
require __DIR__ . '/../../bootstrap.php';

class AuthController
{
    private $userModel;

    public function __construct(User $userModel)
    {
        $this->userModel = $userModel;
    }

    public function register($data)
    {
        $passwordHash = password_hash($data['password'], PASSWORD_BCRYPT);
        $data['password'] = $passwordHash;
        $this->userModel->create($data);

        return Response::successResponse('User registered successfully');
    }

    public function login($data)
    {
        $user = $this->userModel->findByEmail($data['email']);
        if (!$user || !password_verify($data['password'], $user['password'])) {
            return Response::errorResponse('Invalid credentials',[], 401);
        }

        $payload = [
            'iss' => "localhost",
            'iat' => time(),
            'exp' => time() + 60 * 60, //expired 1 jam
            'sub' => $user['id']
        ];

        $jwt = JWT::encode($payload, $_ENV['JWT_SECRET'], 'HS256');
        return Response::successResponse('None',['user' => $user,'token' => $jwt]);
    }
}
