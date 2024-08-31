<?php

declare(strict_types=1);

namespace App\Models;

use App\Enums\CartActionStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

final class ProductTransfer extends Model
{
    use HasFactory;

    const UPDATED_AT = null;

    protected $fillable = [
        'user_id',
        'action',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function details()
    {
        return $this->hasMany(TransferDetail::class);
    }

    /**
     * 在庫管理カートで処理した履歴を残すメソッド
     */
    public static function recordCartHistory(array $cart, CartActionStatus $action): void
    {
        $transaction = self::create([
            'user_id' => Auth::id(),
            'action' => $action,
        ]);

        $transaction
            ->details()
            ->createMany($cart);
    }
}
