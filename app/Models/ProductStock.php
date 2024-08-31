<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

final class ProductStock extends Model
{
    use HasFactory;

    const CREATED_AT = null;

    protected $fillable = [
        'product_id',
        'count',
    ];
}
