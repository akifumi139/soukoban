<?php

declare(strict_types=1);

namespace App\Livewire;

use App\Actions\DeleteAction;
use App\Livewire\Forms\ProductForm;
use App\Models\Product;
use Illuminate\Database\Eloquent\Collection;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Url;
use Livewire\Component;

final class DeleteStock extends Component
{
    #[Url]
    public string $search = '';

    public ProductForm $form;

    public array $cart = [];

    public Collection $products;

    public function mount()
    {
        $this->products = Product::with('stock')->get();
    }

    public function render()
    {
        return view('livewire.delete-stock');
    }

    #[Computed]
    public function productList()
    {
        $products = Product::with('stock')
            ->search($this->search)
            ->get();

        return $products->map(function ($product) {
            $status = in_array($product->id, array_keys($this->cart), true) ? '削除候補' : '';

            return (object) [
                'id' => $product->id,
                'name' => $product->name,
                'model_number' => $product->name,
                'categories' => $product->categories->implode('label', ','),
                'status' => $status,
                'count' => number_format($product->stock?->count),
            ];
        });
    }

    public function addCandidates(int $id)
    {
        $product = $this->products->where('id', $id)->first();

        if (! $product) {
            return;
        }

        $this->cart[$id] = [
            'product_id' => $product->id,
            'count' => $product->stock?->count ?? 0,
            'info' => $product,
        ];
    }

    public function removeCandidates(int $id)
    {
        unset($this->cart[$id]);
    }

    public function delete()
    {
        $checkout = new DeleteAction($this->cart);
        $checkout->exec();

        return to_route('stockManager');
    }
}
