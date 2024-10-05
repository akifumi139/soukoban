<?php

declare(strict_types=1);

namespace App\Actions;

use App\Enums\CartActionStatus;
use App\Models\Cart;
use App\Models\Stock;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

final class DeleteItemAction
{
    public function __construct(private array $cart) {}

    public function exec()
    {
        $cartItemParams =
            collect($this->cart)->map(function ($item) {
                return ['quantity' => $item['quantity']];
            })->toArray();

        $deleteItems = array_filter($this->cart, function ($item) {
            return $item['quantity'] == $item['stock'];
        }, ARRAY_FILTER_USE_BOTH);

        $subItems = array_filter($this->cart, function ($item) {
            return $item['quantity'] !== $item['stock'];
        }, ARRAY_FILTER_USE_BOTH);

        DB::transaction(function () use ($deleteItems, $subItems, $cartItemParams) {
            Stock::deleteItem($deleteItems);
            Stock::subQuantity($subItems);

            $cart = Cart::create([
                'action' => CartActionStatus::DELETE_STOCK,
                'user_id' => Auth::id(),
            ]);
            $cart->items()->attach($cartItemParams);
        });

        session()->flash('message', '処分しました');
    }
}
