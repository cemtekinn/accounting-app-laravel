<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\JsonResponse;

class ApiController extends Controller
{
    use AuthorizesRequests;

    protected function success($message = null, $data = [], $status = 200): JsonResponse
    {
        $message = $message ?? __('İşlem Başarılı!');

        return response()->json([
            'status' => 'success',
            'message' => $message,
            'data' => $data,
        ], $status);
    }

    protected function error($message = null, $status = 400): JsonResponse
    {
        $message = $message ?? __('İşlem yapılırken bir hata meydana geldi!');

        return response()->json([
            'status' => 'error',
            'message' => $message,
        ], $status);
    }
}

