<?php

declare(strict_types=1);

namespace App\Cases;

use App\Models\Product;

class GetProductCase
{
    public function handle($productId): array
    {
        $product = Product::query()->findOrFail($productId);

        return $product->toArray();
    }
}
