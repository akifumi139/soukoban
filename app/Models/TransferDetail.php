<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransferDetail extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'product_transfer_id',
        'product_id',
        'count',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class)->withTrashed();
    }
}
