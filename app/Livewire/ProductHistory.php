<?php

declare(strict_types=1);

namespace App\Livewire;

use App\Models\ProductTransfer;
use Livewire\Component;
use Livewire\WithPagination;

final class ProductHistory extends Component
{
    use WithPagination;

    public function render()
    {
        $histories =
            ProductTransfer::orderByDesc('created_at')
                ->paginate(10);

        return view('livewire.product-history', ['histories' => $histories]);
    }
}
