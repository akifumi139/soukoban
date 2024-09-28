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

    public static function addQuantity($cart)
    {
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
    }
}
