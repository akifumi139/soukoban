<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

final class ToolBox extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'item_id',
        'user_id',
        'quantity',
    ];

    public function item()
    {
        return $this->belongsTo(Item::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public static function add(array $cart): void
    {
        $items = array_map(function ($item) {
            return [
                'item_id' => $item['item_id'],
                'user_id' => Auth::id(),
                'quantity' => $item['quantity'],
            ];
        }, $cart);

        self::insert(
            $items
        );
    }

    public static function remove(array $cart): void
    {
        foreach ($cart as $item) {
            $toolBoxes = ToolBox::where('item_id', $item['item_id'])
                ->orderBy('id')
                ->get();

            foreach ($toolBoxes as $toolBox) {
                if ($item['quantity'] < $toolBox->quantity) {
                    $toolBox->quantity -= $item['quantity'];
                    $toolBox->save();
                    break;
                }

                $item['quantity'] -= $toolBox->quantity;
                $toolBox->delete();
            }
        }

    }
}
