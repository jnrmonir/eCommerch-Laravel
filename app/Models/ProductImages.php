<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductImages extends Model
{
    protected $fillable=[
        'images'
    ];
    function get_product(){
        return $this->belongsTo(Product::class,'product_id');
    }
}
