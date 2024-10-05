<?php

declare(strict_types=1);

namespace App\Livewire\StockManager;

use App\Actions\DeleteItemAction;
use App\Livewire\CartComponent;
use App\Models\Item;
use Livewire\Attributes\Computed;
use Livewire\Attributes\On;

final class DeleteStock extends CartComponent
{
    public function render()
    {
        return view('livewire.stock-manager.delete.index');
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

    #[On('delete-stock')]
    public function deleteStock($cart)
    {
        (new DeleteItemAction($cart))->exec();

        return redirect()->route('stock-manager.delete');
    }
}
