<?php

namespace App\Controllers\Api;

use App\Controllers\BaseController;
use App\Models\UserModel;
use App\Models\TokenModel;

class AuthController extends BaseController
{
    public function login()
    {
        $json = $this->request->getJson();

        if(!$json || !isset($json->email, $json->password)){
            return $this->response
            ->setStatusCode(400)
            ->setJSON(['error' => 'Email and password are required']);
        }

        $userModel = new UserModel();
        $user = $userModel->where('email', $json->email)->first();

        if(!$user || !password_verify($json->password, $user['password'])){
            return $this->response
            ->setStatusCode(401)
            ->setJSON(['error'=> 'Invalid credentials']);
        }

        $rawToken = bin2hex(random_bytes(32));
        $hashedToken = hash('sha256', $rawToken);

        $tokenModel = new TokenModel();
        $tokenModel-> insert([
            'user_id'=> $user['id'],
            'practice_id'=> $user['practice_id'],
            'token'=> $hashedToken,
            'expires_at' => date('Y-m-d H:i:s', strtotime('+8 hours')),
        ]);

        return $this->response
        ->setStatusCode(200)
        ->setJSON([
            'token' => $rawToken,
            'user' => [
                'id'=> $user['id'],
                'name' => $user['name'],
            ]
        ]);
    }
}