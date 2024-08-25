<?php

namespace App\Actions;

use App\Models\Product;
use App\Models\ProductTransfer;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CheckoutAction
{
    public array $cart;

    public function __construct($cart)
    {
        $this->cart = $cart;
    }

    public function run(): void
    {
        $productCounts = array_column($this->cart, 'count', 'product_id');
        $products = $this->getProducts(array_keys($productCounts));

        $remainingStock = $this->calcRemainingStock($products, $productCounts);

        DB::transaction(function () use ($remainingStock) {
            $this->updateProductStocks($remainingStock);
            $this->logCartTransaction($this->cart, '持ち出し');
        });
    }

    private function getProducts(array $productIds)
    {
        return Product::with('stock')
            ->whereIn('id', $productIds)
            ->get();
    }

    private function calcRemainingStock($products, array $productCounts)
    {
        return $products->mapWithKeys(function ($product) use ($productCounts) {
            return [$product->id => $product->stock_count - $productCounts[$product->id]];
        });
    }

    private function updateProductStocks($remainingStock): void
    {
        $caseStatements = $remainingStock->map(function ($stockCount, $productId) {
            return "WHEN product_id = {$productId} THEN {$stockCount}";
        })->implode(' ');

        $productIds = $remainingStock->keys()->implode(',');

        DB::update("
            UPDATE product_stocks
            SET count = CASE
                {$caseStatements}
                ELSE count
            END
            WHERE product_id IN ({$productIds})
        ");
    }

    private function logCartTransaction(array $cart, string $action): void
    {
        $transaction = ProductTransfer::create([
            'user_id' => Auth::id(),
            'action' => $action,
        ]);

        $transaction->details()->createMany($cart);
    }
}
