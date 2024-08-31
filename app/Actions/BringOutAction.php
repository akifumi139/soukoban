<?php

declare(strict_types=1);

namespace App\Actions;

use App\Enums\CartActionStatus;
use App\Models\Product;
use App\Models\ProductStock;
use App\Models\ProductTransfer;
use Illuminate\Support\Facades\DB;

/**
 * 「持ち出し」を異動履歴に追加する
 */
final class BringOutAction
{
    public function __construct(private array $cart) {}

    public function exec(): void
    {
        $remainingStock = $this->calcRemainingStock();

        DB::transaction(function () use ($remainingStock) {
            ProductStock::updateCounts($remainingStock);
            ProductTransfer::recordCartHistory($this->cart, CartActionStatus::BRING_OUT);
        });
    }

    private function calcRemainingStock(): array
    {
        $ids = array_column($this->cart, 'product_id');
        $products = Product::with('stock')
            ->whereIn('id', $ids)
            ->get()
            ->keyBy('id');

        return $products->mapWithKeys(function ($product) {
            return [$product->id => $product->stock_count - $this->cart[$product->id]['count']];
        })->toArray();
    }
}
