<?php

declare(strict_types=1);

namespace App\Cases;

use App\Exceptions\CreateOrderException;
use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderProduct;
use Exception;
use Illuminate\Support\Facades\Auth;
use App\Enums\OrderStatusesEnum;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class CreateOrderCase
{
    private const LOG_CHANNEL_NAME = 'createorder';

    public function handle(): int
    {
        DB::beginTransaction();
        try {
            $userId = Auth::id();
            $cart = Cart::query()->get()->where('user_id', $userId)->firstOrFail();
            $cartProducts = $cart->cartProducts;
            $order = new Order(['user_id' => $userId, 'status' => OrderStatusesEnum::Awaiting]);
            $order->saveOrFail();
            $orderProductsArr = [];
            foreach ($cartProducts as $cartProduct) {
                $orderProductsArr[] = ['order_id' => $order->id, 'product_id' => $cartProduct->product_id];
                $cartProduct->delete();
            }
            OrderProduct::query()->insert($orderProductsArr);
            $cart->delete();
        } catch (Exception $exception) {
            DB::rollBack();
            Log::channel(self::LOG_CHANNEL_NAME)->info($exception->getMessage());
            throw new CreateOrderException('Order not created', 0, $exception);
        }
        DB::commit();

        return $order->id;
    }
}
