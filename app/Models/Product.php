<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $guarded = [];


    public function category()
    {
        return $this->belongsToMany(Category::class, 'category_id');
    }

    public function brand()
    {
        return $this->belongsToMany(Brand::class, 'brand_id');
    }
}
