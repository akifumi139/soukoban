<?php

declare(strict_types=1);

namespace App\Actions;

use App\Enums\CartActionStatus;
use App\Models\Cart;
use App\Models\Stock;
use App\Models\ToolBox;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

/**
 * 「持ち出し」
 */
final class BringOutAction
{
    public function __construct(private array $cart) {}

    public function exec(): void
    {
        $cartItemParams =
            collect($this->cart)->map(function ($item) {
                return ['quantity' => $item['quantity']];
            })->toArray();

        DB::transaction(function () use ($cartItemParams) {
            Stock::removeQuantity($this->cart);
            ToolBox::add($this->cart);
            $cart = Cart::create([
                'action' => CartActionStatus::BRING_OUT,
                'user_id' => Auth::id(),
            ]);

            $cart->items()->attach($cartItemParams);
        });

        session()->flash('message', '工具箱に入れました！！');
    }
}
