<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api;

use App\Cases\GetProductCase;
use App\Cases\GetProductListCase;
use App\Http\Controllers\Controller;
use App\Http\Requests\GetProductListRequest;
use App\Http\Requests\GetProductRequest;
use Illuminate\Http\JsonResponse;

class ProductController extends Controller
{
    public function get(GetProductRequest $request, GetProductCase $case): JsonResponse
    {
        $requestData = $request->validated();
        $productId = (int)$requestData['id'];
        $product = $case->handle($productId);

        return response()->json(['product' => $product], 200, ['Content-Type' => 'string']);
    }

    public function list(GetProductListRequest $request, GetProductListCase $case): JsonResponse
    {
        $requestData = $request->validated();
        $sortType = $requestData['sort_type'] ?? null;
        $products = $case->handle($sortType);

        return response()->json(['products' => $products], 200, ['Content-Type' => 'string']);
    }
}
