<?php

declare(strict_types=1);

namespace App\Livewire;

use App\Models\Cart;
use Livewire\Component;
use Livewire\WithPagination;

final class MovementHistory extends Component
{
    use WithPagination;

    public function render()
    {
        $histories =
            Cart::orderByDesc('created_at')
                ->paginate(10);

        return view('livewire.movement-history.index', ['histories' => $histories]);
    }
}
