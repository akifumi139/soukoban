<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

final class ToolBox extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_id',
        'user_id',
        'count',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class)->withTrashed();
    }

    public static function add(array $cart): void
    {
        $products = array_map(function ($product) {
            return [
                'product_id' => $product['product_id'],
                'user_id' => Auth::id(),
                'count' => $product['count'],
            ];
        }, $cart);

        self::insert(
            $products
        );
    }

    public static function remove(array $cart): void
    {
        foreach ($cart as $return) {
            $toolBoxes = ToolBox::where('product_id', $return['product_id'])
                ->orderBy('id')
                ->get();

            $returnCount = $return['count'];

            foreach ($toolBoxes as $toolBox) {
                $currentCount = $toolBox->count;

                if ($returnCount >= $currentCount) {
                    $returnCount -= $currentCount;
                    $toolBox->delete();
                } else {
                    $toolBox->count -= $returnCount;
                    $toolBox->save();
                    break;
                }
            }
        }
    }
}
