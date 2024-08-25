<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory, SoftDeletes;

    public $timestamps = false;

    protected $fillable = [
        'name',
        'model_number'
    ];

    public function scopeSearch($query, ?string $searchTerm)
    {
        if (is_null($searchTerm)) {
            return $query;
        }

        return
            $query
            ->where('name', 'like', "%{$searchTerm}%")
            ->orWhere('model_number', 'like', "%{$searchTerm}%");
    }

    public function getStockCountAttribute()
    {
        return $this->stock->count;
    }

    public function stock()
    {
        return $this->hasOne(ProductStock::class);
    }
}
