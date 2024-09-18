<?php

declare(strict_types=1);

namespace App\Livewire\Forms;

use App\Models\Category;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\Validate;
use Livewire\Form;

final class CategoryForm extends Form
{
    public ?Category $category;

    #[Validate('required')]
    public string $label = '';

    public function setValue(Category $category)
    {
        $this->category = $category;

        $this->label = $category->label;
    }

    public function update()
    {
        DB::transaction(function () {
            $this->category->update([
                'label' => $this->label,
            ]);
        });

        $this->reset(['category', 'label']);
    }
}
