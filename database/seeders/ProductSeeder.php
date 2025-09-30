<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $products = [
            ["category_id" => 1, "name" => 'MS100 Main Switch', "description" => "100A 4P main switch with rotary handle", "price" => 0.00, "created_at" => now(), "updated_at" => now()],
            ["category_id" => 1, "name" => 'MS250 Main Switch', "description" => "250A 3P high-capacity main switch", "price" => 0.00, "created_at" => now(), "updated_at" => now()],
            ["category_id" => 2, "name" => 'TB125 Tie Breaker', "description" => "125A manual tie breaker with locking feature", "price" => 0.00, "created_at" => now(), "updated_at" => now()],
            ["category_id" => 2, "name" => 'TB160 Tie Breaker', "description" => "160A automatic tie breaker with interlock", "price" => 0.00, "created_at" => now(), "updated_at" => now()],
            ["category_id" => 3, "name" => 'DB Single Phase', "description" => "Single-phase DB with 6 ways", "price" => 0.00, "created_at" => now(), "updated_at" => now()],
            ["category_id" => 3, "name" => 'DB Three Phase', "description" => "Three-phase DB with 12 ways", "price" => 0.00, "created_at" => now(), "updated_at" => now()],
            ["category_id" => 4, "name" => 'Starter Panel', "description" => "DOL starter panel for motors", "price" => 0.00, "created_at" => now(), "updated_at" => now()],
            ["category_id" => 4, "name" => 'PLC Control Panel', "description" => "Programmable logic controller integrated panel", "price" => 0.00, "created_at" => now(), "updated_at" => now()],
            ["category_id" => 5, "name" => 'Copper Busbar 100A', "description" => "High-conductivity copper busbar", "price" => 0.00, "created_at" => now(), "updated_at" => now()],
            ["category_id" => 5, "name" => 'Aluminum Busbar 200A', "description" => "Lightweight aluminum busbar for power distribution", "price" => 0.00, "created_at" => now(), "updated_at" => now()],
            ["category_id" => 6, "name" => 'Relay 230V', "description" => "Electromecha nical relay 230V 10A", "price" => 0.00, "created_at" => now(), "updated_at" => now()],
            ["category_id" => 6, "name" => 'Contactor 40A', "description" => "Contactor for 3-phase 40A control", "price" => 0.00, "created_at" => now(), "updated_at" => now()],
            ["category_id" => 7, "name" => 'Cable Lug', "description" => "Insulated copper cable lugs 10mm2", "price" => 0.00, "created_at" => now(), "updated_at" => now()],
            ["category_id" => 7, "name" => 'PVC Trunking', "description" => "PVC cable management trunking 25x25mm", "price" => 0.00, "created_at" => now(), "updated_at" => now()],
            ["category_id" => 8, "name" => '1kVA Transformer', "description" => "Single-phase 1kVA transformer", "price" => 0.00, "created_at" => now(), "updated_at" => now()],
            ["category_id" => 8, "name" => '5kVA Transformer', "description" => "Three-phase 5kVA transformer for industrial use", "price" => 0.00, "created_at" => now(), "updated_at" => now()],
            ["category_id" => 9, "name" => 'MCB 10A', "description" => "Residual Current Circuit Breaker 10A DP", "price" => 0.00, "created_at" => now(), "updated_at" => now()],
            ["category_id" => 9, "name" => 'RCCB 63A', "description" => "Residual Current Circuit Breaker 63A DP", "price" => 0.00, "created_at" => now(), "updated_at" => now()],
            ["category_id" => 10, "name" => 'Digital Voltmeter', "description" => "Panel mount digital voltmeter 0- 500V", "price" => 0.00, "created_at" => now(), "updated_at" => now()],
            ["category_id" => 10, "name" => 'Energy Meter', "description" => "Three-phase digital energy meter with RS485", "price" => 0.00, "created_at" => now(), "updated_at" => now()],
            ["category_id" => 1, "name" => '125A Isolator Switch', "description" => "125A Isolator Switch", "price" => 0.00, "created_at" => now(), "updated_at" => now()],
            ["category_id" => 1, "name" => '100A Changeover Switch', "description" => "100A Changeover Switch", "price" => 0.00, "created_at" => now(), "updated_at" => now()],
            ["category_id" => 2, "name" => '250A Molded Case Circuit Breaker', "description" => "250A Molded Case Circuit Breaker", "price" => 0.00, "created_at" => now(), "updated_at" => now()],
            ["category_id" => 3, "name" => '32A Distribution Board', "description" => "32A Distribution Board", "price" => 0.00, "created_at" => now(), "updated_at" => now()],
            ["category_id" => 2, "name" => '16A Miniature Circuit Breaker', "description" => "16A Miniature Circuit Breaker", "price" => 0.00, "created_at" => now(), "updated_at" => now()],
            ["category_id" => 1, "name" => '100A Main Switch', "description" => "100A Main Switch", "price" => 0.00, "created_at" => now(), "updated_at" => now()],
            ["category_id" => 1, "name" => '63A Main Switch', "description" => "63A Main Switch", "price" => 0.00, "created_at" => now(), "updated_at" => now()],
            ["category_id" => 3, "name" => '63A Distribution Board', "description" => "63A Distribution Board", "price" => 0.00, "created_at" => now(), "updated_at" => now()],
            ["category_id" => 1, "name" => '250A Isolator Switch', "description" => "250A Isolator Switch", "price" => 0.00, "created_at" => now(), "updated_at" => now()],
            ["category_id" => 2, "name" => '32A Miniature Circuit Breaker', "description" => "32A Miniature Circuit Breaker", "price" => 0.00, "created_at" => now(), "updated_at" => now()],
            ["category_id" => 2, "name" => '125A Molded Case Circuit Breaker', "description" => "125A Molded Case Circuit Breaker", "price" => 0.00, "created_at" => now(), "updated_at" => now()],
            ["category_id" => 1, "name" => '200A Changeover Switch', "description" => "200A Changeover Switch", "price" => 0.00, "created_at" => now(), "updated_at" => now()],
            ["category_id" => 1, "name" => '160A Main Switch', "description" => "160A Main Switch", "price" => 0.00, "created_at" => now(), "updated_at" => now()],
            ["category_id" => 1, "name" => '100A Isolator Switch', "description" => "100A Isolator Switch", "price" => 0.00, "created_at" => now(), "updated_at" => now()],
            ["category_id" => 2, "name" => '400A Molded Case Circuit Breaker', "description" => "400A Molded Case Circuit Breaker", "price" => 0.00, "created_at" => now(), "updated_at" => now()],
            ["category_id" => 2, "name" => '10A Miniature Circuit Breaker', "description" => "10A Miniature Circuit Breaker", "price" => 0.00, "created_at" => now(), "updated_at" => now()],
            ["category_id" => 1, "name" => '63A Changeover Switch', "description" => "63A Changeover Switch", "price" => 0.00, "created_at" => now(), "updated_at" => now()],
            ["category_id" => 1, "name" => '200A Main Switch', "description" => "200A Main Switch", "price" => 0.00, "created_at" => now(), "updated_at" => now()],
            ["category_id" => 3, "name" => '125A Distribution Board', "description" => "125A Distribution Board", "price" => 0.00, "created_at" => now(), "updated_at" => now()],
            ["category_id" => 1, "name" => '200A Isolator Switch', "description" => "200A Isolator Switch", "price" => 0.00, "created_at" => now(), "updated_at" => now()],

        ];


        foreach ($products as $product) {
            $found = DB::table('products')->where('category_id', $product["category_id"])->where('name', $product["name"])->where('description', $product["description"])->first();

            if (!$found) {
                DB::table('products')->insert([
                    'category_id' => $product['category_id'],
                    'name' => $product['name'],
                    'description' => $product['description'],
                    'price'  => $product['price'],
                    'created_at' => now(),
                    'updated_at' => now()
                ]);
            }
        }
    }
}
