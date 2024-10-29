<?php

declare(strict_types=1);

namespace App\Cases;

use App\Models\Order;
use Illuminate\Support\Facades\Auth;

class GetOrderCase
{
    public function handle(int $orderId): array
    {
        $userId = Auth::id();
        $order = Order::query()->where(['id' => $orderId, 'user_id' => $userId])->firstOrFail();

        return $order->toArray();
    }
}
