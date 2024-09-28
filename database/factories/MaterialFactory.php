<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Fakers\MinecraftFakerServiceProvider;
use App\Fakers\ModelNumberProvider;
use App\Models\Item;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Material>
 */
final class MaterialFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $faker = \Faker\Factory::create();
        $faker->addProvider(new ModelNumberProvider($faker));
        $faker->addProvider(new MinecraftFakerServiceProvider($faker));

        return [
            'model_number' => $faker->modelNumber(),
            'name' => $faker->minecraftItem(),
        ];
    }

    public function withItem(array $categoryNameList, $stockQuantity)
    {
        return $this->state(function (array $attributes) use ($categoryNameList, $stockQuantity) {
            $item = Item::factory()
                ->withCategories($categoryNameList)
                ->withStock($stockQuantity)
                ->create();

            return [
                'item_id' => $item->id,
            ];
        });
    }
}
