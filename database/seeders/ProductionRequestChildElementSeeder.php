<?php

namespace Database\Seeders;

use App\Models\ProductionRequest;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Carbon\Carbon;

class ProductionRequestChildElementSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $productionRequests = ProductionRequest::all();

        $images = [
            '2_dMxAtFY.png',
            '4_LYeDMYY.png',
            '5_710kykO.png',
            '6_UMmSbAS.png',
            '7_gYXcNbt.png',
            '11_qZLVMe9.png',
        ];

        $names = [
            'Spare Circuit Breaker #6',
            'Cooling Fan #3',
            'Mounting Plate #2',
            'Wiring Kit #4',
            'Fuse Holder #5',
            'Protective Cover #1'
        ];

        foreach ($productionRequests as $pr) {
            for ($i = 0; $i <= 5; $i++) {
                $unit_price  = number_format(mt_rand(100, 999) + mt_rand(0, 99) / 100, 2, '.', '');
                $total_price = number_format(mt_rand(1000, 9999) + mt_rand(0, 99) / 100, 2, '.', '');

                $pr->childElements()->create([
                    'po_id'     => $pr->id,
                    'child_element_id' => $i + 1,
                    'quantity'   => rand(1, 10),
                    'name' => $names[$i],
                    'image' => $images[$i],
                    'unit_price' => $unit_price,
                    'total_price' => $total_price,
                    'date_order' => Carbon::now()->subDays(rand(0, 365))->format('Y-m-d'),
                    'created_at' => now(),
                    'updated_at' => now()
                ]);
            }
        }
    }
}
