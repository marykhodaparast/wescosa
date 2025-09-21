<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            ["name" => "Main Switches", "description" => "", "created_at" => now(), "updated_at" => now()],
            ["name" => "Tie Breakers", "description" => "", "created_at" => now(), "updated_at" => now()],
            ["name" => "Distribution Boards", "description" => "", "created_at" => now(), "updated_at" => now()],
            ["name" => "Control Panels", "description" => "", "created_at" => now(), "updated_at" => now()],
            ["name" => "Busbars", "description" => "", "created_at" => now(), "updated_at" => now()],
            ["name" => "Relays & Contactors", "description" => "", "created_at" => now(), "updated_at" => now()],
            ["name" => "Wiring Accessories", "description" => "", "created_at" => now(), "updated_at" => now()],
            ["name" => "Transformers", "description" => "", "created_at" => now(), "updated_at" => now()],
            ["name" => "Protective Devices", "description" => "", "created_at" => now(), "updated_at" => now()],
            ["name" => "Monitoring Equipments", "description" => "", "created_at" => now(), "updated_at" => now()],

        ];
        foreach ($categories as $category) {
            $found = DB::table('categories')->where('name', $category["name"])->where('description', $category["description"])->first();

            if (!$found) {
                DB::table('categories')->create([
                    'name' => $category['name'],
                    'description' => $category['description'],
                    'created_at' => now(),
                    'updated_at' => now()
                ]);
            }
        }
    }
}
