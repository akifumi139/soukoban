<?php

namespace App\Livewire;

use App\Actions\CheckoutAction;
use App\Livewire\Forms\ProductForm;
use App\Models\Product;
use Illuminate\Database\Eloquent\Collection;
use Livewire\Attributes\Url;
use Livewire\Component;

class AddStock extends Component
{
    public string $selectedProduct = '';

    #[Url]
    public string $search = '';

    public ProductForm $form;

    public array $cart = [];

    public Collection $stocks;

    public bool $showAddCountModal;

    public function mount()
    {
        $this->stocks = Product::get();
    }
    public bool $showAddModal = false;

    public function render()
    {
        return view('livewire.add-stock');
    }

    public function addCart(int $id = null)
    {
        if (is_null($id)) {
            $id = now()->format('YmdHis');
            $status = '新規';
        } else {
            $status = '個数追加';
        }

        $this->cart[$id]
            = (object) [
                'id' => $id,
                'name' => $this->form->name,
                'model_number' => $this->form->modelNumber,
                'count' => $this->form->count,
                'status' => $status,
            ];

        $this->reset(['showAddModal', 'showAddCountModal', 'form.name', 'form.modelNumber', 'form.count']);
    }

    public function addCountProduct()
    {
        $product = $this->stocks->where('id', $this->selectedProduct)->first();

        $this->form->name = $product->name;
        $this->form->modelNumber = $product->model_number;

        $this->addCart($product->id);
    }

    public function removeCart(int $id)
    {
        unset($this->cart[$id]);
    }

    public function add()
    {
        $checkout = new CheckoutAction($this->cart);
        $checkout->add();

        return to_route('stockManager');
    }
}
