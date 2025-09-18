<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

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
