<?php

declare(strict_types=1);

namespace App\Cases;

use App\Models\Cart;
use App\Models\CartProduct;
use Illuminate\Support\Facades\Auth;

class AddProductInCartCase
{

    public function handle(int $productId): void
    {
        $userId = Auth::id();
        $cart = Cart::query()->get()->where('user_id', $userId)->first();
        if (!$cart) {
            $cart = new Cart(['user_id' => $userId]);
            $cart->saveOrFail();
        }
        $productInCart = new CartProduct(['cart_id' => $cart->id, 'product_id' => $productId]);
        $productInCart->saveOrFail();
    }
}
