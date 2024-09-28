<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\Material;
use Illuminate\Database\Seeder;

final class MaterialSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $materials = [
            ['name' => 'ダイヤモンド', 'categories' => ['鉱石'], 'stock' => 23],
            ['name' => 'レッドストーン', 'categories' => ['鉱石'], 'stock' => 56],
            ['name' => 'ネザー', 'categories' => ['鉱石'], 'stock' => 12],
            ['name' => '金のリンゴ', 'categories' => ['食料'], 'stock' => 23],
            ['name' => '鉄のインゴット', 'categories' => ['鉱石'], 'stock' => 67],
            ['name' => '石炭', 'categories' => ['鉱石'], 'stock' => 54],
            ['name' => '羊毛', 'categories' => ['その他'], 'stock' => 65],
            ['name' => 'エメラルド', 'categories' => ['鉱石'], 'stock' => 27],
            ['name' => '砂糖', 'categories' => ['食料'], 'stock' => 48],
        ];

        foreach ($materials as $material) {
            Material::factory(
                [
                    'name' => $material['name'],
                ]
            )
                ->withItem($material['categories'], $material['stock'])
                ->create();
        }
    }
}
