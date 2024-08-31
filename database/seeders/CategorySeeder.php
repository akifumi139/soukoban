<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

final class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categoryLabels = [
            '鉱石',
            '食料',
            '道具',
            'その他',
        ];

        $params = array_map(function ($category) {
            return [
                'label' => $category,
            ];
        }, $categoryLabels);

        Category::insert($params);
    }
}
