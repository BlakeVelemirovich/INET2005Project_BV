<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    // Category (dropdown), Title, Description, Price, Quantity, SKU, Picture
    protected $fillable = [
        'categoryId',
        'title',
        'description',
        'price',
        'quantity',
        'sku',
        'picture',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class, 'categoryId');
    }
}
