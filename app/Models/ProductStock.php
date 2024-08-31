<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

final class ProductStock extends Model
{
    use HasFactory;

    const CREATED_AT = null;

    protected $fillable = [
        'product_id',
        'count',
    ];

    public static function updateCounts(array $countList): void
    {
        if (empty($countList)) {
            return;
        }

        $caseStatementList = array_map(function ($count, $productId) {
            return "WHEN product_id = {$productId} THEN {$count}";
        }, $countList, array_keys($countList));

        $caseStatement = implode(',', $caseStatementList);
        $conditionStatement = implode(',', array_keys($countList));

        DB::update("
            UPDATE product_stocks
            SET count = CASE
                {$caseStatement}
                ELSE count
            END
            WHERE product_id IN ({$conditionStatement})
        ");
    }
}
