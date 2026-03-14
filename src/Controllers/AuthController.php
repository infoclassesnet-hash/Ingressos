<?php

namespace App\\Controllers;

use Firebase\\JWT\\JWT;
use Firebase\\JWT\\Key;

class AuthController {

    private $secretKey = 'your_secret_key'; // Change to your actual secret key

    public function login($username, $password) {
        // Implement your login logic here (e.g., checking credentials)

        // On successful login, generate a JWT token
        $token = $this->generateJWT($username);
        return ['token' => $token];
    }

    public function register($username, $password) {
        // Implement your registration logic here (e.g., saving user info)
        // For example, you could hash the password and store it in the database.
    }

    private function generateJWT($username) {
        $issuedAt = time();
        $expirationTime = $issuedAt + 3600;  // jwt valid for 1 hour

        $payload = [
            'iat' => $issuedAt,
            'exp' => $expirationTime,
            'username' => $username
        ];

        return JWT::encode($payload, $this->secretKey, 'HS256');
    }
}
