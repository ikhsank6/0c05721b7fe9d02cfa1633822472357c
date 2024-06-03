<?php

namespace App\Helpers;

class Response
{

    public static function json($data, $status = 200)
    {
        self::header();
        http_response_code($status);
        echo json_encode($data);
    }

    public static function successResponse(string $message = null, array $data = [], int $statusCode = 200)
    {
        http_response_code($statusCode);

        $response = [
            'status' => true,
            'message' => $message,
            'data' => $data
        ];
       self::header();
        echo json_encode($response);
    }

    public static function errorResponse(string $message = null, array $data = [], int $statusCode = 500)
    {
        http_response_code($statusCode);
        $response = [
            'status' => false,
            'message' => $message,
            'data' => $data
        ];
        self::header();
        echo json_encode($response);
    }

    private static function header()
    {
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: OPTIONS,GET,POST,PUT,DELETE");
    header("Access-Control-Max-Age: 3600");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
    }
}
