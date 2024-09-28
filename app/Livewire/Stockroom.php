<?php

declare(strict_types=1);

namespace App\Livewire;

use App\Actions\BringOutAction;
use App\Models\Item;
use Livewire\Attributes\Computed;
use Livewire\Attributes\On;

final class Stockroom extends CartComponent
{
    public function render()
    {
        return view('livewire.stockroom.index');
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

    #[On('bring-out')]
    public function bringOut($cart)
    {
        (new BringOutAction($cart))->exec();

        return redirect()->route('stockroom');
    }
}
