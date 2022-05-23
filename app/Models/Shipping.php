<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Shipping extends Model
{
    function get_order(){
        return $this->hasOne(Order::class,'order_id'); //many product have in this order table
    }
}
