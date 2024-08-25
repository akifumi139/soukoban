<?php

namespace App\Fakers;

use Faker\Provider\Base;

class MinecraftFakerServiceProvider extends Base
{
    protected static $terms = [
        'ダイヤモンド',
        'レッドストーン',
        'ネザー',
        'クラフト台',
        'エンチャント台',
        'ビーコン',
        '鉄の剣',
        '金のリンゴ',
        '鉄のインゴット',
        '木の丸太',
        '石炭',
        'チェスト',
        'シルクタッチ',
        'エンダーパール',
        '松明',
        '羊毛',
        '石のツルハシ',
        '鉄のシャベル',
        '金の剣',
        'エメラルド',
        '砂糖',
        'クワ',
        '弓',
        '矢',
        '火打ち石',
    ];

    public function minecraftItem()
    {
        return static::randomElement(static::$terms);
    }
}
