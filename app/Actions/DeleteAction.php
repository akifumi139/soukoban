<?php

declare(strict_types=1);

namespace App\Actions;

use App\Enums\CartActionStatus;
use App\Models\Product;
use App\Models\ProductTransfer;
use Illuminate\Support\Facades\DB;

final class DeleteAction
{
    public function __construct(private array $cart) {}

    public function exec()
    {
        DB::transaction(function () {
            Product::whereIn('id', array_keys($this->cart))->delete();
            ProductTransfer::recordCartHistory($this->cart, CartActionStatus::REMOVAL);
        });
    }
}
