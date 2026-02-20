<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;

class HealthController extends Controller
{
    public function __invoke(): JsonResponse
    {
        $dbStatus = 'error';
        $dbMessage = '';

        try {
            DB::select('SELECT 1');
            $dbStatus = 'ok';
        } catch (\Throwable $e) {
            $dbMessage = $e->getMessage();
        }

        $data = [
            'status'    => $dbStatus === 'ok' ? 'healthy' : 'unhealthy',
            'framework' => 'Laravel ' . app()->version(),
            'php'       => PHP_VERSION,
            'database'  => [
                'status'  => $dbStatus,
                'message' => $dbMessage ?: 'Connected successfully',
            ],
            'timestamp' => now()->toIso8601String(),
        ];

        return response()->json($data);
    }
}

