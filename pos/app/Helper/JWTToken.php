<?php

namespace App\Helper;

use Exception;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;

class JWTToken
{
    public static function createToken($userEmail, $userID): string
    {
        $key = env('JWT_token');

        $payload = [
            'iss' => 'laravel-token',
            'iat' => time(),
            'exp' => time() + 60 * 60,
            'userEmail' => $userEmail,
            'userID' => $userID
        ];
        return $jwt = JWT::encode($payload, $key, 'HS256');
    }

    public static function createTokenPasswordSet($userEmail): string
    {
        $key = env('JWT_token');

        $payload = [
            'iss' => 'laravel-token',
            'iat' => time(),
            'exp' => time() + 60 * 5,
            'userEmail' => $userEmail,
            'userID' => '0'
        ];
        return JWT::encode($payload, $key, 'HS256');
    }



    public static function veryfyToken($jwtToken): string|object
    {

        try {

            if ($jwtToken == NULL) {
                return 'Unauthorized';
            } else {
                $key = env('JWT_token');
                $decoded = JWT::decode($jwtToken, new Key($key, 'HS256'));
                return  $decoded;
            }
        } catch (Exception $e) {
            return 'Unauthorized';
        }
    }
}
