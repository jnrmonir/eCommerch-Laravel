<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    function get_product(){
        return $this->belongsTo(Product::class,'product_id'); //many product have in this order table
    }
    function get_shipping(){
        return $this->belongsTo(Shipping::class,'shipping_id'); 
    }
}
