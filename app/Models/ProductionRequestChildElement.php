<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductionRequestChildElement extends Model
{
    protected $fillable = [
        'po_id',
        'child_element_id',
        'quantity',
        'image',
        'name',
        'unit_price',
        'total_price',
        'supplier',
        'supplier_contact_email',
        'supplier_contact_phone',
        'date_order',
        'eta_child',
        'ata_child',
        'status_child',
        'inspection_remarks',
        'production_manager_remarks',
        'qr',
    ];
    
    public function product()
    {
        return $this->belongsTo(ProductionRequest::class, 'po_id');
    }

    public function childElement()
    {
        return $this->belongsTo(ProductChildElement::class, 'child_element_id');
    }
}
