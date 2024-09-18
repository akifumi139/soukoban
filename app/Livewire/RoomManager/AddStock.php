<?php

declare(strict_types=1);

namespace App\Livewire\RoomManager;

use App\Actions\AddAction;
use App\Livewire\Forms\ProductForm;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Eloquent\Collection;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Url;
use Livewire\Component;

final class AddStock extends Component
{
    #[Url]
    public string $search = '';

    public ProductForm $form;

    public array $cart = [];

    public Collection $categories;

    public Collection $stocks;

    public bool $showAddModal = false;

    public bool $showAddCountModal = false;

    public string $selectedProduct = '';

    public function mount()
    {
        $this->categories = Category::get()->keyBy('label');
        $this->stocks = Product::get()->keyBy('id');
    }

    public function render()
    {
        return view('livewire.room-manager.product.add.index');
    }

    public function selectCategory($option)
    {
        $this->form->category = $option;
    }

    #[Computed]
    public function filleterCategories()
    {
        return Category::get();
    }

    public function addCart(?int $id = null)
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
                'modelNumber' => $this->form->modelNumber,
                'category' => $this->form->category,
                'categoryId' => $this->categories->get($this->form->category),
                'count' => $this->form->count,
                'status' => $status,
            ];

        $this->reset(['showAddModal', 'showAddCountModal']);
        $this->form->reset();
    }

    public function addCountProduct(): void
    {
        $product = $this->stocks->get($this->selectedProduct);

        if (is_null($product)) {
            return;
        }

        $this->form->setValue($product);
        $this->addCart($product->id);
    }

    public function removeCart(int $id): void
    {
        unset($this->cart[$id]);
    }

    public function add()
    {
        if (empty($this->cart)) {
            return;
        }

        $checkout = new AddAction($this->cart);
        $checkout->exec();

        return to_route('roomManager');
    }
}
