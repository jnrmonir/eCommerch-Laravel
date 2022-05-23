<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use League\CommonMark\Extension\Attributes\Node\Attributes;

class Color extends Model
{
    function attributes(){
        return $this->hasMany(ProductAttributes::class,'color_id');
    }
}
