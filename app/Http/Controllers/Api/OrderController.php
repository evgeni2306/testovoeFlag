<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api;

use App\Cases\CreateOrderCase;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;

class OrderController extends Controller
{
    /**
     * @param CreateOrderCase $case
     * @return JsonResponse
     */
    public function create(CreateOrderCase $case): JsonResponse
    {
        $orderId = $case->handle();

        return response()->json(['order_id' => $orderId], 200, ['Content-Type' => 'string']);
    }
}
