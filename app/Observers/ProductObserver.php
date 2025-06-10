<?php

namespace App\Observers;

use App\Models\Product;
use Illuminate\Support\Str;

class ProductObserver
{
    public function creating(Product $product): void
    {
        $product->stock_code = $this->stockCode($product);
    }

    private function stockCode(Product $product): string
    {
        $namePart = Str::upper(Str::substr($product->name, 0, 3));
        $categoryName = $product->category->name ?? 'GEN';
        $categoryPart = Str::upper(Str::substr($categoryName, 0, 3));
        $idPart = str_pad($product->id, 4, '0', STR_PAD_LEFT);
        return "{$namePart}-{$categoryPart}-{$idPart}";
    }
}
