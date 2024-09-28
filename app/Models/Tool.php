<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

final class Tool extends Model
{
    use HasFactory;

    public $timestamps = false;

    public function item()
    {
        return $this->belongsTo(Item::class);
    }

    public function stock()
    {
        return $this->belongsTo(Stock::class);
    }

    public function getQuantityAttribute()
    {
        return $this->stock->quantity;
    }
}
