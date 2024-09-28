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
 * 返却
 */
final class GiveBackAction
{
    public function __construct(private array $cart) {}

    public function exec(): void
    {

        $cartItemParams =
        collect($this->cart)->map(function ($item) {
            return ['quantity' => $item['quantity']];
        })->toArray();

        DB::transaction(function () use ($cartItemParams) {
            ToolBox::remove($this->cart);
            Stock::addQuantity($this->cart);

            $cart = Cart::create([
                'action' => CartActionStatus::GIVEBACK,
                'user_id' => Auth::id(),
            ]);

            $cart->items()->attach($cartItemParams);
        });

        session()->flash('message', '工具箱に入れました！！');
    }
}
