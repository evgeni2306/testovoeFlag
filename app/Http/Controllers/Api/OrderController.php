<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api;

use App\Cases\CreateOrderCase;
use App\Cases\PayOrderCase;
use App\Http\Controllers\Controller;
use App\Http\Requests\CreateOrderRequest;
use Illuminate\Http\JsonResponse;

class OrderController extends Controller
{
    /**
     * @param CreateOrderCase $case
     * @return JsonResponse
     */
    public function create(CreateOrderRequest $request, CreateOrderCase $case): JsonResponse
    {
        $requestData = $request->validated();
        $paymentRoute = $case->handle($requestData['payment_type']);

        return response()->json(['payment_url' => $paymentRoute], 200, ['Content-Type' => 'string']);
    }

    public function pay(int $id, string $type, PayOrderCase $case): JsonResponse
    {
        $updateRoute = $case->handle($id, $type);

        return response()->json(['update_url' => $updateRoute], 200, ['Content-Type' => 'string']);
    }

    public function update(int $id)
    {

    }
}
