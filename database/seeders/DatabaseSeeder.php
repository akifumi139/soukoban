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
            'login_id' => 'soukoban',
            'name' => '管理者',
        ]);

        User::factory()->create([
            'login_id' => 'taro',
            'name' => '従業員A',
            'role' => '一般',
        ]);

        $this->call([
            CategorySeeder::class,
            ToolSeeder::class,
            MaterialSeeder::class,
        ]);
    }
}
