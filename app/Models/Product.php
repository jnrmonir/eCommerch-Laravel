<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable=[
        'category_id',
        'subcategory_id',
        'title',
        'slug',
        'summary',
        'description',
        'thumbnail',
    ];

    function get_category(){
        return $this->belongsTo(Category::class,'category_id');
    }
    function get_subcategory(){
        return $this->belongsTo(SubCategory::class,'subcategory_id');
    }
    function get_product_images(){
        return $this->hasMany(ProductImages::class,'product_id');
    }
    function product_attribute(){
        return $this->hasMany(ProductAttribute::class,'product_id');
    }
    function get_cart(){
        return $this->hasMany(Cart::class,'product_id');
    }
    function get_order(){
        return $this->hasMany(Order::class,'product_id');
    }
}
