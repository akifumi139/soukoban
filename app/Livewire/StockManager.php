<?php

namespace App\Livewire;

use App\Livewire\Forms\ProductForm;
use App\Models\Product;
use Illuminate\Database\Eloquent\Collection;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Url;
use Livewire\Component;

class StockManager extends Component
{
    #[Url]
    public string $search = '';

    #[Url]
    public string $mode = '追加';

    public ProductForm $form;

    public array $cart = [];

    public bool $showModal = false;
    public bool $showAddModal = false;

    public Collection $products;

    public function mount()
    {
        $this->products = Product::with('stock')->get();
    }

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

    public function add()
    {
        $this->form->save();

        $this->reset(['showAddModal']);
    }

    public function delete($id)
    {
        Product::destroy($id);
    }
}
