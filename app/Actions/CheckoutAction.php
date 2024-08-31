<?php

declare(strict_types=1);

namespace App\Actions;

use App\Models\Category;
use App\Models\Product;
use App\Models\ProductTransfer;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

final class CheckoutAction
{
    public array $cart;

    public function __construct($cart)
    {
        $this->cart = $cart;
    }

    /**
     * 「持ち出し」を異動履歴に追加する
     */
    public function bringOut(): void
    {
        $productCounts = array_column($this->cart, 'count', 'product_id');
        $products = $this->getProducts(array_keys($productCounts));

        $remainingStock = $this->calcRemainingStock($products, $productCounts);

        DB::transaction(function () use ($remainingStock) {
            $this->updateProductStocks($remainingStock);
            $this->logCartTransaction($this->cart, '持ち出し');
        });
    }

    public function add(): void
    {
        $stocks = Product::get();
        $categories = Category::get();

        DB::transaction(function () use ($categories, $stocks) {
            $products = [];
            foreach ($this->cart as $cartItem) {
                if ($cartItem->status == '新規') {
                    $product = Product::create([
                        'name' => $cartItem->name,
                        'model_number' => $cartItem->model_number,
                    ]);

                    $product->stock()
                        ->create(['count' => $cartItem->count]);

                    $category =
                        $categories
                            ->where('label', $cartItem->category)
                            ->first();
                    $product->categories()
                        ->sync($category->id);
                } else {
                    $product =
                        $stocks
                            ->where('id', $cartItem->id)
                            ->first();

                    $product->stock()
                        ->update(['count' => $product->StockCount + $cartItem->count]);
                }

                $products[] = [
                    'product_id' => $product->id,
                    'count' => $product->StockCount,
                    'info' => $product,
                ];
            }

            $this->logCartTransaction($products, '追加');
        });
    }

    public function delete(): void
    {
        DB::transaction(function () {
            Product::whereIn('id', array_keys($this->cart))->delete();
            $this->logCartTransaction($this->cart, '削除');
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
