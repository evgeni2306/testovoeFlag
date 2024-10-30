<?php

declare(strict_types=1);

namespace App\Cases;

use App\Models\Product;

class GetProductListCase
{
    /**
     * @param string|null $sortType
     * @return array
     */
    public function handle(string $sortType = null): array
    {
        $products = Product::query();
        if ($sortType !== null) {
            $products = $products->orderBy('price', $sortType);
        }
        $products = $products->get()->all();

        return $products;
    }
}
