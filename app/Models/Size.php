<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Size extends Model
{
    function attributes(){
        return $this->hasMany(ProductAttribute::class,'size_id');
    }
}
