<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

final class Stock extends Model
{
    use HasFactory;

    const CREATED_AT = null;

    public static function addItems($cart)
    {
        $category = Category::firstOrCreate([
            'name' => '道具',
        ]);

        $newIds = [];
        //道具
        foreach ($cart as $tool) {
            $item = Item::create([
                'stock_id' => $tool['quantity'],
            ]);

            $item->categories()->attach([$category->id]);

            Tool::create([
                'item_id' => $item->id,
                'model_number' => $tool['model_number'],
                'name' => $tool['name'],
            ]);

            $newIds[$tool['item_id']] = $item->id;
        }

        return $newIds;
    }

    public static function addQuantity(array $cart): bool
    {
        if (empty($cart)) {
            return false;
        }
        $caseStatements = collect($cart)->map(function ($item) {
            return "WHEN id = {$item['item_id']} THEN quantity + {$item['quantity']}";
        })->implode(' ');

        $conditionStatements = collect($cart)->pluck('item_id')->implode(',');

        DB::update("
            UPDATE stocks
            SET quantity = CASE
                {$caseStatements}
                ELSE quantity
            END
            WHERE id IN ({$conditionStatements})
        ");

        return true;
    }

    public static function removeQuantity($cart)
    {
        $caseStatements = collect($cart)->map(function ($item) {
            return "WHEN id = {$item['item_id']} THEN quantity - {$item['quantity']}";
        })->implode(' ');

        $conditionStatements = collect($cart)->pluck('item_id')->implode(',');

        DB::update("
            UPDATE stocks
            SET quantity = CASE
                {$caseStatements}
                ELSE quantity
            END
            WHERE id IN ({$conditionStatements})
        ");
    }

    public static function deleteItem(array $cart): void
    {
        $itemIds = array_map(function ($item) {
            return $item['item_id'];
        }, $cart);

        Item::whereIn('id', $itemIds)->delete();
    }

    public static function subQuantity(array $cart): bool
    {
        if (empty($cart)) {
            return false;
        }

        $caseStatements = collect($cart)->map(function ($item) {
            return "WHEN id = {$item['item_id']} THEN quantity - {$item['quantity']}";
        })->implode(' ');

        $conditionStatements = collect($cart)->pluck('item_id')->implode(',');

        DB::update("
            UPDATE stocks
            SET quantity = CASE
                {$caseStatements}
                ELSE quantity
            END
            WHERE id IN ({$conditionStatements})
        ");

        return true;
    }
}
