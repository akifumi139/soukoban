<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Fakers\MinecraftFakerServiceProvider;
use App\Fakers\ModelNumberProvider;
use App\Models\ProductStock;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
final class ProductFactory extends Factory
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

    public function withStock()
    {
        return $this->has(ProductStock::factory(), 'stock');
    }
}
