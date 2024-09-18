<?php

declare(strict_types=1);

namespace App\Livewire;

use App\Actions\BringOutAction;
use App\Models\Product;
use Livewire\Attributes\Computed;
use Livewire\Attributes\On;
use Livewire\Component;

final class Stockroom extends Component
{
    public string $search = '';

    public function render()
    {
        return view('livewire.stockroom.index');
    }

    #[Computed]
    public function productList()
    {
        $products = Product::with(['stock', 'categories'])
            ->search($this->search)
            ->get();

        return $products->groupBy('first_category');
    }

    #[On('bring-out')]
    public function bringOut($cart)
    {
        (new BringOutAction($cart))->exec();

        session()->flash('message', '工具箱に入れました！！');

        return redirect()->route('stockroom');
    }
}
