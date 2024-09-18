<?php

declare(strict_types=1);

namespace App\Livewire;

use App\Actions\GiveBackAction;
use App\Models\Product;
use Livewire\Attributes\Computed;
use Livewire\Attributes\On;
use Livewire\Component;

final class MyStuff extends Component
{
    public string $search = '';

    public function render()
    {
        return view('livewire.myStuff.index');
    }

    #[Computed]
    public function productList()
    {
        $products = Product::with(['categories'])
            ->whereHas('stuff')
            ->search($this->search)
            ->get();

        return $products->groupBy('first_category');
    }

    #[On('give-back')]
    public function giveBack($cart)
    {
        (new GiveBackAction($cart))->exec();
        session()->flash('message', '返却しました！！');

        return redirect()->route('myStuff');
    }
}
