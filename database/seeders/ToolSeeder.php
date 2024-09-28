<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\Tool;
use Illuminate\Database\Seeder;

final class ToolSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $tools = [
            ['name' => 'クラフト台', 'categories' => ['道具'], 'stock' => 6],
            ['name' => 'エンチャント台', 'categories' => ['道具'], 'stock' => 3],
            ['name' => 'ビーコン', 'categories' => ['道具'], 'stock' => 4],
            ['name' => '鉄の剣', 'categories' => ['道具'], 'stock' => 7],
        ];

        foreach ($tools as $tool) {
            Tool::factory(
                [
                    'name' => $tool['name'],
                ]
            )
                ->withItem($tool['categories'], $tool['stock'])
                ->create();
        }
    }
}
