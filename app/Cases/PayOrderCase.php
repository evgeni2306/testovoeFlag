<?php

declare(strict_types=1);

namespace App\Cases;

use App\Enums\OrderStatusesEnum;
use App\Enums\TypesOfPaymentEnum;
use App\Exceptions\PayOrderException;
use App\Exceptions\UnknownPaymentTypeException;
use App\Models\Order;

class PayOrderCase
{
    private const UPDATE_ROUTE_NAME = 'update_order';

    /**
     * @param int $orderId
     * @param string $paymentType
     * @return string
     * @throws PayOrderException
     * @throws UnknownPaymentTypeException
     */
    public function handle(int $orderId, string $paymentType): string
    {
        if (TypesOfPaymentEnum::tryFrom($paymentType) === null) {
            throw new UnknownPaymentTypeException();
        }

        $order = Order::query()->findOrFail($orderId);
        if ($order->status !== OrderStatusesEnum::Awaiting->value) {
            throw new PayOrderException();
        }

        return route(self::UPDATE_ROUTE_NAME, ['id' => $order->id]);
    }
}
