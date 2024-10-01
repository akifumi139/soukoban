<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

final class Item extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'stock_id',
        'quantity',
    ];

    public function toolBoxes()
    {
        return $this->hasMany(ToolBox::class);
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }

    public function stock()
    {
        return $this->belongsTo(Stock::class);
    }

    public function tool()
    {
        return $this->hasOne(Tool::class);
    }

    public function material()
    {
        return $this->hasOne(Material::class);
    }

    public function scopeSearch($query, string $keyword = '')
    {
        if ($keyword === '') {
            return $query;
        }

        return
            $query
                ->whereHas('tool', function ($query) use ($keyword) {
                    $query->where('name', 'like', "%{$keyword}%")
                        ->orWhere('model_number', 'like', "%{$keyword}%");
                })
                ->orWhereHas('material', function ($query) use ($keyword) {
                    $query->where('name', 'like', "%{$keyword}%")
                        ->orWhere('model_number', 'like', "%{$keyword}%");
                });
    }

    public function scopeCategoryFilter($query, array $filters = [])
    {
        if (empty($filters)) {
            return $query;
        }

        return $query
            ->whereHas('categories', function ($query) use ($filters) {
                $query->whereIn('name', $filters);
            });
    }

    public function getTypeAttribute()
    {
        return $this->categories->contains('name', '道具') ? 'tool' : 'material';
    }

    public function getNameAttribute()
    {
        if ($this->type == 'tool') {
            return $this->tool->name;
        }

        return $this->material->name;
    }

    public function getModelNumberAttribute()
    {
        if ($this->type == 'tool') {
            return $this->tool->model_number;
        }

        return $this->material->model_number;
    }

    public function getQuantityAttribute()
    {
        return $this->stock->quantity;
    }

    public function getMyStockAttribute()
    {
        $quantity = $this->toolBoxes->where('user_id', Auth::id())->sum('quantity');

        return number_format($quantity);
    }

    public function getBorrowersAttribute()
    {
        return $this->toolBoxes->pluck('user')->unique();
    }
}
