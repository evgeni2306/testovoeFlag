<?php

declare(strict_types=1);

namespace App\Cases;

use App\Models\Order;
use Illuminate\Support\Facades\Auth;

class GetOrderListCase
{
    /**
     * @param string|null $sortType
     * @param string|null $statusFilter
     * @return array
     */
    public function handle(string $sortType = null, string $statusFilter = null): array
    {
        $userId = Auth::id();

        $orderList = Order::query()->where('user_id', $userId);

        if ($sortType !== null) {
            $orderList = $orderList->orderBy('created_at', $sortType);
        }

        if ($statusFilter !== null) {
            $orderList = $orderList->where('status', $statusFilter);
        }

        return $orderList->get()->toArray();
    }
}
