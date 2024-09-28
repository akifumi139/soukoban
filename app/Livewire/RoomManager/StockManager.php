<?php

declare(strict_types=1);

namespace App\Livewire\RoomManager;

use App\Livewire\Forms\ProductForm;
use App\Models\Category;
use App\Models\Item;
use Illuminate\Support\Collection;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Url;
use Livewire\Component;

final class StockManager extends Component
{
    #[Url]
    public string $search = '';

    public array $filters = [];

    public ProductForm $form;

    public Collection $categories;

    public Collection $itemList;

    public function mount()
    {
        $this->categories = Category::get();
        $this->itemList = Item::get();
    }

    public function render()
    {
        return view('livewire.room-manager.index');
    }

    #[Computed]
    public function items()
    {
        return Item::with(['categories', 'tool', 'tool.stock', 'material', 'material.stock'])
            ->whereHas('toolBoxes')
            ->search($this->search)
            ->categoryFilter($this->filters)
            ->get()
            ->sortBy('name');
    }

    public function setProduct(int $id)
    {
        $this->reset(['form.name', 'form.modelNumber', 'form.category', 'form.categoryId']);

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
        return to_route('roomManager');
    }
}
