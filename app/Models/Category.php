<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Category extends Model
{
    protected $fillable=[
        'category_name',
        'slug'
    ];
    use SoftDeletes;

    function get_subcategory(){
        // return $this->hasOne('App\Models\SubCategory');
        return $this->hasOne(SubCategory::class);
    }
    function get_product(){
        // one to many
        return $this->hasMany(Product::class,'category_id');
    }
}
