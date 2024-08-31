<?php

declare(strict_types=1);

namespace App\Actions;

use App\Enums\CartActionStatus;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductTransfer;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

final class AddAction
{
    public function __construct(private array $cart) {}

    public function exec(): void
    {
        $stocks = Product::get()->keyBy('id');

        $this->insetNewCategory();

        DB::transaction(function () use ($stocks) {
            $products = [];

            foreach ($this->cart as $cartItem) {
                $product = $this->handleCartItem($cartItem, $stocks);

                $products[] = [
                    'product_id' => $product->id,
                    'count' => $cartItem->count,
                ];
            }

            ProductTransfer::recordCartHistory($products, CartActionStatus::DELIVERY);
        });
    }

    private function insetNewCategory()
    {
        $newCategories = array_unique(
            array_map(
                fn ($item) => $item->category,
                array_filter($this->cart, fn ($item) => $item->categoryId === null)
            )
        );

        $prams = array_map(
            fn ($name) => ['label' => $name],
            $newCategories
        );

        Category::insert($prams);
    }

    private function handleCartItem(object $cartItem, Collection $stocks): Product
    {
        if ($cartItem->status == '新規') {
            $product = $this->createProduct($cartItem);
        } else {
            $product = $this->updateProductStock($cartItem, $stocks);
        }

        return $product;
    }

    private function createProduct(object $cartItem): Product
    {
        $product = Product::create([
            'name' => $cartItem->name,
            'model_number' => $cartItem->modelNumber,
        ]);

        $product->stock()
            ->create(['count' => $cartItem->count]);

        $product->categories()->sync($cartItem->categoryId);

        return $product;
    }

    private function updateProductStock(object $cartItem, Collection $stocks): Product
    {
        $product = $stocks->get($cartItem->id);

        if ($product) {
            $product->stock()
                ->update(['count' => $product->stock->count + $cartItem->count]);
        }

        return $product;
    }
}
