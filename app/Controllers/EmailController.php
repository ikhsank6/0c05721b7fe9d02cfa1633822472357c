<?php

namespace App\Controllers;

use App\Services\EmailService;
use App\Helpers\Response;
use App\Models\Email;

class EmailController
{
    private $emailService;

    public function __construct(EmailService $emailService)
    {
        $this->emailService = $emailService;
        // if (isset($_SERVER['HTTP_AUTHORIZATION']) && preg_match('/^Bearer\s(\S+)/', $_SERVER['HTTP_AUTHORIZATION'], $matches)) {
        //     $token = $matches[1]; // Extract the token
        //     // echo "Bearer token: $token";
        // } else {
        //     // Handle case where Authorization header is missing or does not contain a Bearer token
        //     echo "Bearer token not found";
        // }
    }

    public function sendEmail($data)
    {
        $this->emailService->send($data);
        return Response::successResponse('Email sent successfully');
    }
}
