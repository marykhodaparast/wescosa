<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        $found = User::where('name', 'admin')->where('email', 'admin@example.com')->first();
        if (!$found) {
            User::factory()->firstOrCreate([
                'name' => 'admin',
                'email' => 'admin@example.com',
                'password' => bcrypt('password123'),
            ]);
        }

        $this->call(CategorySeeder::class);
        $this->call(ProductSeeder::class);
    }
}
