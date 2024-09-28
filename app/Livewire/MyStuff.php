<?php

declare(strict_types=1);

namespace App\Livewire;

use App\Actions\GiveBackAction;
use App\Models\Item;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Computed;
use Livewire\Attributes\On;

final class MyStuff extends CartComponent
{
    public function render()
    {
        return view('livewire.my-stuff.index');
    }

    #[Computed]
    public function items()
    {
        return Item::with(['categories', 'tool', 'tool.stock', 'material', 'material.stock'])
            ->whereHas('toolBoxes')
            ->search($this->search)
            ->categoryFilter($this->filters)
            ->whereHas('toolBoxes', function ($query) {
                $query->where('user_id', Auth::id());
            })
            ->get()
            ->sortBy('name');
    }

    #[On('give-back')]
    public function giveBack($cart)
    {
        (new GiveBackAction($cart))->exec();

        return redirect()->route('myStuff');
    }
}
