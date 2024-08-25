<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductStock extends Model
{
    use HasFactory;

    const CREATED_AT = null;

    protected $fillable = [
        'product_id',
        'count',
    ];
}
