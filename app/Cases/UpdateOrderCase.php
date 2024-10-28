<?php

declare(strict_types=1);

namespace App\Cases;

use App\Enums\OrderStatusesEnum;
use App\Exceptions\UpdateOrderException;
use App\Models\Order;

class UpdateOrderCase
{
    public function handle(int $oderId): void
    {
        $order = Order::query()->findOrFail($oderId);

        if ($order->status !== OrderStatusesEnum::Awaiting->value) {
            throw new UpdateOrderException();
        }
        $order->status = OrderStatusesEnum::Paid->value;
        $order->saveOrFail();
    }
}
