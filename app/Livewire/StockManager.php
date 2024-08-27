<?php

namespace App\Livewire;

use App\Models\Product;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Url;
use Livewire\Component;

class StockManager extends Component
{
    #[Url]
    public string $search = '';

    public function render()
    {
        return view('livewire.stock-manager');
    }

    #[Computed]
    public function productList()
    {
        return Product::with('stock')
            ->search($this->search)
            ->get();
    }
}
