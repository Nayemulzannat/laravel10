<?php

namespace App\Helper;

use Exception;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;

class JWTToken
{
    public static function createToken($userEmail): string
    {
        $key = env(key: 'JWT_token');

        $payload = [
            'iss' => 'laravel-token',
            'iat' => time(),
            'exp' => time() * 60 * 60,
            'userEmail' => $userEmail
        ];
        return $jwt = JWT::encode($payload, $key, 'HS256');
    }



    public static function veryfyToken($jwtToken)
    {

        try {
            $key = env(key: 'JWT_token');
            $decoded = JWT::decode($jwtToken, new Key($key, 'HS256'));
            return  $decoded->userEmail;
        } catch (Exception $e) {
            return 'Unauthorized';
        }
    }
}
