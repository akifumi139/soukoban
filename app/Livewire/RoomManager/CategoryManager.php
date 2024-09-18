<?php

declare(strict_types=1);

namespace App\Livewire\RoomManager;

use App\Livewire\Forms\CategoryForm;
use App\Models\Category;
use Illuminate\Support\Collection;
use Livewire\Component;

final class CategoryManager extends Component
{
    public Collection $categories;

    public CategoryForm $form;

    public bool $showEditModal = false;

    public function mount()
    {
        $this->categories = Category::with('products')->get()->keyBy('id');
    }

    public function render()
    {
        return view('livewire.room-manager.category.index');
    }

    public function setCategory(int $id)
    {
        $category = $this->categories->get($id);

        // $this->form->setValue($category);

        // $this->reset(['showEditModal']);
    }
}
