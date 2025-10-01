<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class ProductionRequest extends Model
{
    protected $fillable = [
        'job_number',
        'po_number',
        'product_name_id',
        'project_name',
        'customer',
        'customer_contact_email',
        'customer_contact_phone',
        'status',
        'actions',
        'no_of_structures',
        'no_of_workers',
        'feeders',
        'main',
        'tie',
        'request_date',
        'start_date',
        'end_date',
        'etd',
        'atd',
    ];

    protected static function booted()
    {
        static::created(function ($productionRequest) {

            // $productionRequest->update([
            //     'no_of_structures' => rand(1, 30),
            //     'no_of_workers'    => rand(1, 30),
            //     'feeders'          => rand(1, 30),
            //     'main'             => rand(1, 30),
            //     'tie'              => rand(1, 30),
            // ]);

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

            foreach (range(1, 6) as $i) {
                $productionRequest->childElements()->create([
                    'child_element_id' => $i,
                    'quantity'         => rand(1, 10),
                    'name'             => $names[$i - 1],
                    'image'            => $images[$i - 1],
                    'unit_price'       => number_format(mt_rand(100, 999) + mt_rand(0, 99) / 100, 2, '.', ''),
                    'total_price'      => number_format(mt_rand(1000, 9999) + mt_rand(0, 99) / 100, 2, '.', ''),
                    'date_order'       => Carbon::now()->subDays(rand(0, 365))->format('Y-m-d'),
                ]);
            }
        });
    }



    // Define relationship to Product model
    public function product()
    {
        return $this->belongsTo(Product::class, 'product_name_id');
    }

    public function childElements()
    {
        return $this->hasMany(ProductionRequestChildElement::class, 'po_id');
    }
}
