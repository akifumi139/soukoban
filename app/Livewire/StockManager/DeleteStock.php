<?php

declare(strict_types=1);

namespace App\Livewire\StockManager;

use App\Livewire\CartComponent;
use App\Models\Item;
use Livewire\Attributes\Computed;
use Livewire\Attributes\On;

final class DeleteStock extends CartComponent
{
    public function render()
    {
        return view('livewire.stock-manager.delete-stock');
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
    public function RemoveStock($cart) {}
}
