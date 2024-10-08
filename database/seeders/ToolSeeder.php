<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\Tool;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;

final class ToolSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $filePath = config('init-file-path.tools');
        $csvFile = Storage::disk('local')->get($filePath);

        $csv = explode("\n", str_replace(["\r\n", "\r"], "\n", $csvFile));
        array_shift($csv);
        $tools = array_map(function ($date) {
            [$name,$model_number,$stock] = explode(',', $date);

            return [
                'name' => $name,
                'model_number' => $model_number,
                'stock' => intval($stock),
            ];
        }, $csv);

        $categories = ['道具'];
        foreach ($tools as $tool) {
            Tool::factory(
                [
                    'name' => $tool['name'],
                    'model_number' => $tool['model_number'],
                ]
            )
                ->withItem($categories, $tool['stock'])
                ->create();
        }
    }
}
