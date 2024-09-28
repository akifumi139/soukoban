<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\Category;
use App\Models\Item;
use App\Models\Stock;
use Illuminate\Database\Eloquent\Factories\Factory;

final class ItemFactory extends Factory
{
    protected $model = Item::class;

    public function definition(): array
    {
        return [
            //
        ];
    }

    public function withStock(?int $quantity = null)
    {
        return $this->state(function (array $attributes) use ($quantity) {
            $params = [];

            if ($quantity) {
                $params['quantity'] = $quantity;
            }
            $stock = Stock::factory($params)->create();

            return [
                'stock_id' => $stock->id,
            ];
        });
    }

    public function withCategories(array $categoryNameList)
    {
        return $this->afterCreating(function (Item $item) use ($categoryNameList) {
            $existingCategories =
                Category::whereIn('name', $categoryNameList)
                    ->pluck('name')
                    ->toArray();
            $newCategoryNames = array_diff($categoryNameList, $existingCategories);

            Category::insert(array_map(function ($name) {
                return ['name' => $name];
            }, $newCategoryNames));

            $categoryIds = Category::whereIn('name', $categoryNameList)->pluck('id');

            $item->categories()->attach($categoryIds);
        });
    }
}
