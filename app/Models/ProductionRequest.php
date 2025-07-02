<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductionRequest extends Model
{
    protected $fillable = [
        'job_number',
        'product_name',
        'project_name',
        'customer',
        'no_of_structures',
        'no_of_workers',
        'feeders',
        'main',
        'tie',
        'request_date',
        'start_date',
        'end_date',
        'etd',  // Estimated Time of Departure  ,
        'atd',  // Actual Time of Departure
    ];
}
