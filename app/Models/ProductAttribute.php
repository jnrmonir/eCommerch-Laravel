<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductAttribute extends Model
{
    protected $fillable=[
        'color_id','size_id',
    ];
    function get_color(){
        return $this->belongsTo(Color::class,'color_id');
    }
    function get_size(){
        return $this->belongsTo(Size::class,'size_id');
    }
    function get_product(){
        return $this->belongsTo(Product::class,'product_id');
    }
}
