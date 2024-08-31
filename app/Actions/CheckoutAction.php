<?php

declare(strict_types=1);

namespace App\Actions;

use App\Models\Product;
use App\Models\ProductTransfer;
use Illuminate\Support\Facades\DB;

final class CheckoutAction
{
    public array $cart;

    public function __construct($cart)
    {
        $this->cart = $cart;
    }

    public function delete(): void
    {
        DB::transaction(function () {
            Product::whereIn('id', array_keys($this->cart))->delete();
            ProductTransfer::recordCartHistory($this->cart, '削除');
        });
    }
}
