<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ProductChildElement extends Model
{
    protected $fillable = [
        'id', 'product_id', 'name', 'description', 'price', 'image', 'quantity', 'specifications'
    ];

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class, 'product_id');
    }

    public function productionRequestChildElements()
    {
        return $this->hasMany(ProductionRequestChildElement::class, 'child_element_id');
    }
}
