<?php

namespace App\Livewire\Forms;

use App\Models\Product;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\Validate;
use Livewire\Form;

class ProductForm extends Form
{
    #[Validate('required')]
    public string $name = '';

    #[Validate('required')]
    public string $modelNumber = '';

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

        $this->reset(['name', 'modelNumber', 'count']);
    }
}
