<?php

declare(strict_types=1);

namespace App\Actions;

use App\Enums\CartActionStatus;
use App\Models\Product;
use App\Models\ProductStock;
use App\Models\ProductTransfer;
use App\Models\ToolBox;
use Illuminate\Support\Facades\DB;

/**
 * 「返却」を異動履歴に追加する
 */
final class GiveBackAction
{
    public function __construct(private array $cart) {}

    public function exec(): void
    {
        $remainingStock = $this->calcStock();

        DB::transaction(function () use ($remainingStock) {
            ProductStock::updateCounts($remainingStock);
            ToolBox::remove($this->cart);
            ProductTransfer::recordCartHistory($this->cart, CartActionStatus::GIVEBACK);
        });
    }

    private function calcStock(): array
    {
        $ids = array_column($this->cart, 'product_id');
        $products = Product::with('stock')
            ->whereIn('id', $ids)
            ->get()
            ->keyBy('id');

        return $products->mapWithKeys(function ($product) {
            return [$product->id => $product->stock_count + $this->cart[$product->id]['count']];
        })->toArray();
    }
}
