<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api;

use App\Cases\CreateOrderCase;
use App\Cases\GetOrderListCase;
use App\Cases\GetOrderCase;
use App\Cases\PayOrderCase;
use App\Cases\UpdateOrderCase;
use App\Exceptions\CreateOrderException;
use App\Exceptions\PayOrderException;
use App\Exceptions\UnknownPaymentTypeException;
use App\Exceptions\UpdateOrderException;
use App\Http\Controllers\Controller;
use App\Http\Requests\CreateOrderRequest;
use App\Http\Requests\GetOrderListRequest;
use App\Http\Requests\GetOrderRequest;
use Illuminate\Http\JsonResponse;
use Throwable;

class OrderController extends Controller
{
    /**
     * @param CreateOrderRequest $request
     * @param CreateOrderCase $case
     * @return JsonResponse
     * @throws Throwable
     * @throws CreateOrderException
     */
    public function create(CreateOrderRequest $request, CreateOrderCase $case): JsonResponse
    {
        $requestData = $request->validated();
        $paymentRoute = $case->handle($requestData['payment_type']);

        return response()->json(['payment_url' => $paymentRoute], 200, ['Content-Type' => 'string']);
    }

    /**
     * @param int $id
     * @param string $type
     * @param PayOrderCase $case
     * @return JsonResponse
     * @throws PayOrderException
     * @throws UnknownPaymentTypeException
     */
    public function pay(int $id, string $type, PayOrderCase $case): JsonResponse
    {
        $updateRoute = $case->handle($id, $type);

        return response()->json(['update_url' => $updateRoute], 200, ['Content-Type' => 'string']);
    }

    /**
     * @param int $id
     * @param UpdateOrderCase $case
     * @return JsonResponse
     * @throws UpdateOrderException
     * @throws Throwable
     */
    public function update(int $id, UpdateOrderCase $case): JsonResponse
    {
        $case->handle($id);

        return response()->json(['message' => 'success'], 200, ['Content-Type' => 'string']);
    }

    /**
     * @param GetOrderListRequest $request
     * @param GetOrderListCase $case
     * @return JsonResponse
     */
    public function list(GetOrderListRequest $request, GetOrderListCase $case): JsonResponse
    {
        $requestData = $request->validated();
        $sortType = $requestData['sort_type'] ?? null;
        $statusFilter = $requestData['status_filter'] ?? null;

        $orderList = $case->handle($sortType, $statusFilter);

        return response()->json(['orders' => $orderList], 200, ['Content-Type' => 'string']);
    }

    /**
     * @param GetOrderRequest $request
     * @param GetOrderCase $case
     * @return JsonResponse
     */
    public function get(GetOrderRequest $request, GetOrderCase $case): JsonResponse
    {
        $requestData = $request->validated();
        $orderId = (int)$requestData['id'];

        $order = $case->handle($orderId);

        return response()->json(['order' => $order], 200, ['Content-Type' => 'string']);
    }
}
