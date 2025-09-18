<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\Category;

class Product extends Model
{
    protected $fillable = [
        'id', 'category_id', 'name', 'description', 'price', 'specifications', 'image', 'status'
    ];
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function product_child_elements(): HasMany
    {
        return $this->hasMany(ProductChildElement::class);
    }
}
