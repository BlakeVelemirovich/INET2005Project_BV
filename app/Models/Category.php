<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    // The attributes that are mass assignable.
    protected $fillable = [
        'categoryName',
    ];

    public function items()
    {
        return $this->hasMany(Item::class, 'categoryId');
    }
}
