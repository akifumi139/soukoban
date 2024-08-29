<?php

namespace App\Livewire;

use App\Livewire\Forms\ProductForm;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Eloquent\Collection;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Url;
use Livewire\Component;

class StockManager extends Component
{
    #[Url]
    public string $search = '';

    public ProductForm $form;

    public Collection $categories;

    public Collection $stocks;

    public function mount()
    {
        $this->categories = Category::get();
        $this->stocks = Product::get();
    }

    public function render()
    {
        return view('livewire.stock-manager');
    }

    #[Computed]
    public function productList()
    {
        $products = Product::with(['stock', 'categories'])
            ->search($this->search)
            ->orderBy('id')
            ->get();

        return $products->groupBy('first_category');
    }

    public function setProduct(int $id)
    {
        $product = $this->stocks->where('id', $id)->first();

        $this->form->setValue($product);
    }

    public function update()
    {
        $this->form->categoryId =
            $this->categories
            ->where('label', $this->form->category)
            ->first()
            ?->id;

        $this->form->update();

        //フラグ式の切り替えだとモーダル内を押せなくなるため（Form入力ができない）
        return to_route('stockManager');
    }
}
