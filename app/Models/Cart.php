<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    protected $fillable=[
        'quantity',
    ];
    function get_product(){
      return $this->belongsTo(Product::class,'product_id');
    }
}
