<?php

declare(strict_types=1);

namespace App\Livewire;

use App\Models\Category;
use App\Models\Item;
use Illuminate\Support\Collection;
use Livewire\Component;

class CartComponent extends Component
{
    public string $search = '';

    public array $filters = [];

    public Collection $categories;

    public Collection $itemList;

    public function mount()
    {
        $this->categories = Category::orderBy('name')->get();
        $this->itemList = Item::with(['categories', 'tool', 'tool.stock', 'material', 'material.stock'])
            ->get()
            ->map(function ($item) {
                return [
                    'id' => $item->id,
                    'name' => $item->name,
                    'model_number' => $item->model_number,
                    'stock'=> $item->quantity,
                    'my_stock' => $item->my_stock,
                ];
            });
    }

    public function clearFilter()
    {
        $this->reset('filters');
    }

    public function toggleFilter(string $name)
    {
        if (in_array($name, $this->filters, true)) {
            $key = array_search($name, $this->filters);
            unset($this->filters[$key]);

            return;
        }

        array_push($this->filters, $name);
    }
}
