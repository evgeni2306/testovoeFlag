<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api;

use App\Cases\AddProductInCartCase;
use App\Cases\DeleteProductFromCartCase;
use App\Http\Controllers\Controller;
use App\Http\Requests\AddProductToCartRequest;
use App\Http\Requests\DeleteProductFromCartRequest;
use Illuminate\Http\JsonResponse;
use Throwable;

class CartController extends Controller
{
    /**
     * @param AddProductToCartRequest $request
     * @param AddProductInCartCase $case
     * @return JsonResponse
     * @throws Throwable
     */
    public function addProduct(AddProductToCartRequest $request, AddProductInCartCase $case): JsonResponse
    {
        $requestData = $request->validated();
        $productId = (int)$requestData['id'];
        $case->handle($productId);

        return response()->json(['message' => 'Success'], 200, ['Content-Type' => 'string']);
    }

    /**
     * @param DeleteProductFromCartRequest $request
     * @param DeleteProductFromCartCase $case
     * @return JsonResponse
     */
    public function deleteProduct(DeleteProductFromCartRequest $request, DeleteProductFromCartCase $case): JsonResponse
    {
        $requestData = $request->validated();
        $productId = (int)$requestData['id'];
        $case->handle($productId);

        return response()->json(['message' => 'Success'], 200, ['Content-Type' => 'string']);
    }
}
