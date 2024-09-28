<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

final class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            '鉱石',
            '食料',
            '道具',
            'その他',
        ];

        $params = array_map(function ($category) {
            return ['name' => $category];
        }, $categories);

        Category::insert($params);
    }
}
