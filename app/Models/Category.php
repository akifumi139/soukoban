<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

final class Category extends Model
{
    use HasFactory;

    const UPDATED_AT = null;

    protected $fillable = [
        'name',
    ];

    public function items()
    {
        return $this->belongsToMany(Item::class);
    }
}
