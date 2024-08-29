<?php

namespace App\Livewire\Forms;

use App\Models\Product;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\Validate;
use Livewire\Form;

class ProductForm extends Form
{
    public Product $product;
    #[Validate('required')]
    public string $name = '';

    #[Validate('required')]
    public string $modelNumber = '';

    #[Validate('required')]
    public string $category = '';
    public ?int $categoryId = null;

    #[Validate(['required', 'numeric'])]
    public int $count = 0;

    public function save()
    {
        $this->validate();

        DB::transaction(function () {
            $product = Product::create($this->all());

            $product->stock()
                ->create(['count' => $this->count]);
        });

        $this->reset(['name', 'modelNumber', 'category', 'count']);
    }

    public function setValue(Product $product)
    {
        $this->product = $product;

        $this->name = $product->name;
        $this->modelNumber = $product->model_number;
        $this->category = $product->first_category;
        $this->count = $product->stock_count;
    }

    public function update()
    {
        DB::transaction(function () {
            $this->product->update([
                'name' => $this->name,
                'model_number' => $this->modelNumber,
            ]);

            $this->product
                ->categories()
                ->sync($this->categoryId);
        });


        $this->reset(['name', 'model_number', 'category', 'categoryId']);
    }
}
