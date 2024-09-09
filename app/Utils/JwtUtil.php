<?php

namespace App\Utils;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;

class JwtUtil {

    protected $key;

    public function __construct()
    {
        // Set your secret key here
        $this->key = env('JWT_SECRET');
    }

    public function generateToken($data, $role_id)
    {
        $issuedAt = time();
        $expiration = $issuedAt + 3600; // Token valid for 1 hour

        $payload = [
            'iss' => $role_id, // Issuer
            'iat' => $issuedAt, // Issued at
            'exp' => $expiration, // Expiration time
            'data' => $data // Your custom data
        ];

        return JWT::encode($payload, $this->key, 'HS256');
    }

    public function decodeToken($token)
    {
        try {
            return JWT::decode($token, new Key($this->key, 'HS256'));
        } catch (\Exception $e) {
            return null;
        }
    }
}