<?php

declare(strict_types=1);

namespace App\Cases;

use App\Models\Cart;
use App\Models\CartProduct;
use Illuminate\Support\Facades\Auth;

class DeleteProductFromCartCase
{
    /**
     * @param int $productId
     * @return void
     */
    public function handle(int $productId): void
    {
        $userId = Auth::id();
        $cart = Cart::query()->get()->where('user_id', $userId)->firstOrFail();
        $productInCart = CartProduct::query()->where(['cart_id' => $cart->id, 'product_id' => $productId])->firstOrFail();
        $productInCart->delete();
    }
}
