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
            ["name" => "Main Switches", "description" => "Main switching components for control.", "created_at" => now(), "updated_at" => now()],
            ["name" => "Tie Breakers", "description" => "Devices used to connect sections in switchgear.", "created_at" => now(), "updated_at" => now()],
            ["name" => "Distribution Boards", "description" => "Electrical boards distributing power.", "created_at" => now(), "updated_at" => now()],
            ["name" => "Control Panels", "description" => "Panels containing control circuitry.", "created_at" => now(), "updated_at" => now()],
            ["name" => "Busbars", "description" => "Conductive bars for power distribution.", "created_at" => now(), "updated_at" => now()],
            ["name" => "Relays & Contactors", "description" => "Electromagnetic switches and controls.", "created_at" => now(), "updated_at" => now()],
            ["name" => "Wiring Accessories", "description" => "Tools and accessories for wiring.", "created_at" => now(), "updated_at" => now()],
            ["name" => "Transformers", "description" => "Voltage conversion devices.", "created_at" => now(), "updated_at" => now()],
            ["name" => "Protective Devices", "description" => "MCBs, RCCBs and surge protectors.", "created_at" => now(), "updated_at" => now()],
            ["name" => "Monitoring Equipments", "description" => "Meters and equipment for monitoring.", "created_at" => now(), "updated_at" => now()],

        ];
        foreach ($categories as $category) {
            $found = DB::table('categories')->where('name', $category["name"])->where('description', $category["description"])->first();

            if (!$found) {
                DB::table('categories')->insert([
                    'name' => $category['name'],
                    'description' => $category['description'],
                    'created_at' => now(),
                    'updated_at' => now()
                ]);
            }
        }
    }
}
