<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SubCategory extends Model
{
    use SoftDeletes;
    function get_category(){
        return $this->belongsTo(Category::class,'category_id');
    }
    function get_product(){
        return $this->hasOne(Product::class,'subcategory_id');
    }
}
