<?php

declare(strict_types=1);

namespace App\Cases;

use App\Models\Product;

class GetProductCase
{
    /**
     * @param int $productId
     * @return array
     */
    public function handle(int $productId): array
    {
        $product = Product::query()->findOrFail($productId);

        return $product->toArray();
    }
}
