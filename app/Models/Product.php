<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'mpn',
        'price',
        'sale_price',
        'vip_price',
        'stock',
        'availability',
        'size',
        'parent_id',
        'title',
        'description',
        'image_link',
        'product_type',
        'eta',
        'brand',
        'gender',
        'color',
    ];

    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }

    public function gallery()
    {
        return $this->hasMany(Gallery::class);
    }
}
