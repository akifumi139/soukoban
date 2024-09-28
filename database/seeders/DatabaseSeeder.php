<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

final class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory()->create([
            'name' => 'soukoban',
        ]);

        User::factory()->create([
            'name' => 'taro',
        ]);

        $this->call([
            CategorySeeder::class,
            ToolSeeder::class,
            MaterialSeeder::class,
        ]);
    }
}
