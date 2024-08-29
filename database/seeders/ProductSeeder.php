<?php

namespace Database\Seeders;

use App\Fakers\ModelNumberProvider;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $products = [
            ['name' => 'ダイヤモンド', 'category' => '鉱石', 'stock' => 23],
            ['name' => 'レッドストーン', 'category' => '鉱石', 'stock' => 56],
            ['name' => 'ネザー', 'category' => '鉱石', 'stock' => 12],
            ['name' => 'クラフト台', 'category' => '道具', 'stock' => 89],
            ['name' => 'エンチャント台', 'category' => '道具', 'stock' => 34],
            ['name' => 'ビーコン', 'category' => '道具', 'stock' => 45],
            ['name' => '鉄の剣', 'category' => '道具', 'stock' => 78],
            ['name' => '金のリンゴ', 'category' => '食料', 'stock' => 23],
            ['name' => '鉄のインゴット', 'category' => '鉱石', 'stock' => 67],
            ['name' => '木の丸太', 'category' => '道具', 'stock' => 10],
            ['name' => '石炭', 'category' => '鉱石', 'stock' => 54],
            ['name' => 'チェスト', 'category' => '道具', 'stock' => 82],
            ['name' => 'シルクタッチ', 'category' => '道具', 'stock' => 19],
            ['name' => 'エンダーパール', 'category' => '道具', 'stock' => 33],
            ['name' => '松明', 'category' => '道具', 'stock' => 29],
            ['name' => '羊毛', 'category' => 'その他', 'stock' => 65],
            ['name' => '石のツルハシ', 'category' => '道具', 'stock' => 38],
            ['name' => '鉄のシャベル', 'category' => '道具', 'stock' => 51],
            ['name' => '金の剣', 'category' => '道具', 'stock' => 74],
            ['name' => 'エメラルド', 'category' => '鉱石', 'stock' => 27],
            ['name' => '砂糖', 'category' => '食料', 'stock' => 48],
            ['name' => 'クワ', 'category' => '道具', 'stock' => 59],
            ['name' => '弓', 'category' => '道具', 'stock' => 40],
            ['name' => '矢', 'category' => '道具', 'stock' => 66],
            ['name' => '火打ち石', 'category' => '道具', 'stock' => 31],
        ];

        $faker = \Faker\Factory::create();
        $faker->addProvider(new ModelNumberProvider($faker));

        //データの量が少ないため、最適化していない（テストデータということもある）
        foreach ($products as $params) {
            $product = Product::create([
                'name' => $params['name'],
                'model_number' => $faker->modelNumber(),
            ]);

            $product->stock()->create(['count' => $params['stock']]);
            $category = Category::firstOrCreate(
                ['label' => $params['category']]
            );
            $product->categories()->sync($category->id);
        }
    }
}
