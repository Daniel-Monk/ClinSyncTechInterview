<?php

namespace App\Filters;

use App\Models\TokenModel;
use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;

class AuthFilter implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        $rawToken = $request->getHeaderLine('Authorization');
        $rawToken = str_replace('Bearer', '', $rawToken);

        if (!$rawToken) {
            return service('response')
                ->setStatusCode(401)
                ->setJSON(['error' => 'Unauthorised']);
        }

        $hashedToken = hash('sha256', $rawToken);

        $tokenModel = new TokenModel();
        $token = $tokenModel
            ->where('token', $hashedToken)
            ->where('expires_at >', date('Y-m-d H:i:s'))
            ->where('revoked_at IS NULL', null, false)
            ->first();

        if (!$token) {
            return service('response')
                ->setStatusCode(401)
                ->setJSON(['error' => 'Unauthorised']);
        }

        session()->set('practice_id', $token['practice_id']);
        session()->set('user_id', $token['user_id']);
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null) {}
}
