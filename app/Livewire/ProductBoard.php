<?php

namespace App\Livewire;

use App\Actions\CheckoutAction;
use App\Models\Product;
use Illuminate\Database\Eloquent\Collection;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Url;
use Livewire\Component;

class ProductBoard extends Component
{
    #[Url]
    public string $search = '';

    public array $cart = [];

    public bool $showModal = false;

    public Collection $products;

    public function mount()
    {
        $this->products = Product::with('stock')->get();
    }

    public function render()
    {
        return view('livewire.product-board');
    }

    #[Computed]
    public function productList()
    {
        return Product::with('stock')
            ->search($this->search)
            ->get();
    }


    #[Computed]
    public function cartCount()
    {
        return array_reduce($this->cart, function ($carry, $item) {
            return  $carry + $item['count'];
        }, 0);
    }

    public function addCart(int $id): void
    {
        $product = $this->products->where('id', $id)->first();

        if (!$product || $product->stock_count === 0) {
            return;
        }

        $currentCount = $this->cart[$id]['count'] ?? 0;

        if ($product->stock_count > $currentCount) {
            $this->cart[$id] = [
                'product_id' => $product->id,
                'count' => $currentCount + 1,
                'info' => $product,
            ];
        }
    }

    public function subCart(int $id): void
    {
        if (!array_key_exists($id, $this->cart)) {
            return;
        }

        if ($this->cart[$id]['count'] <= 1) {
            unset($this->cart[$id]);
        } else {
            $this->cart[$id]['count']--;
        }
    }

    public function exceptCart(int $id): void
    {
        unset($this->cart[$id]);
    }

    public function bringOut()
    {
        $checkout = new CheckoutAction($this->cart);

        $checkout->run();

        $this->reset(['showModal', 'cart']);
    }
}
