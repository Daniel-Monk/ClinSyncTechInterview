<?php

namespace App\Controllers\Api;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class Health extends BaseController
{
    public function index(): ResponseInterface
    {
        $dbStatus = 'error';
        $dbMessage = '';

        try {
            $db = \Config\Database::connect();
            $db->query('SELECT 1');
            $dbStatus = 'ok';
        } catch (\Throwable $e) {
            $dbMessage = $e->getMessage();
        }

        $data = [
            'status'    => $dbStatus === 'ok' ? 'healthy' : 'unhealthy',
            'framework' => 'CodeIgniter ' . \CodeIgniter\CodeIgniter::CI_VERSION,
            'php'       => PHP_VERSION,
            'database'  => [
                'status'  => $dbStatus,
                'message' => $dbMessage ?: 'Connected successfully',
            ],
            'timestamp' => date('c'),
        ];

        return $this->response->setJSON($data);
    }
}

