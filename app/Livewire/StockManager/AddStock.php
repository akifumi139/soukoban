<?php

declare(strict_types=1);

namespace App\Livewire\StockManager;

use App\Actions\AddItemAction;
use App\Livewire\CartComponent;
use App\Models\Item;
use Livewire\Attributes\Computed;
use Livewire\Attributes\On;

final class AddStock extends CartComponent
{
    public function render()
    {
        return view('livewire.stock-manager.add.index');
    }

    #[Computed]
    public function items()
    {
        return Item::with(['categories', 'tool', 'tool.stock', 'material', 'material.stock'])
            ->search($this->search)
            ->categoryFilter($this->filters)
            ->get()
            ->sortBy('name');
    }

    #[On('add-stock')]
    public function AddStock($cart)
    {
        (new AddItemAction($cart))->exec();

        return redirect()->route('stock-manager.add');
    }
}
