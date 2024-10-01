<?php

declare(strict_types=1);

namespace App\Actions;

use App\Enums\CartActionStatus;
use App\Models\Cart;
use App\Models\Stock;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

final class AddItemAction
{
    public function __construct(private array $cart) {}

    public function exec(): void
    {
        $cartItemParams =
            collect($this->cart)->map(function ($item) {
                return ['quantity' => $item['quantity']];
            })->toArray();

        $newItems = array_filter($this->cart, function ($value, $key) {
            return mb_strpos(strval($key), 'new') !== false;
        }, ARRAY_FILTER_USE_BOTH);

        $existingItems = array_filter($this->cart, function ($value, $key) {
            return mb_strpos(strval($key), 'new') === false;
        }, ARRAY_FILTER_USE_BOTH);

        DB::transaction(function () use ($newItems, $existingItems, $cartItemParams) {
            $newItemIds = Stock::addItems($newItems);

            foreach ($newItemIds as $key => $newId) {
                $cartItemParams[$newId] = $cartItemParams[$key];
                unset($cartItemParams[$key]);
            }
            Stock::addQuantity($existingItems);

            $cart = Cart::create([
                'action' => CartActionStatus::GIVEBACK,
                'user_id' => Auth::id(),
            ]);

            $cart->items()->attach($cartItemParams);
        });

        session()->flash('message', '追加しました');
    }
}
