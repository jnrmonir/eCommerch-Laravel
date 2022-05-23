<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\ProductAttribute;
use Illuminate\Http\Request;

class FrontendController extends Controller
{
    function FrontPage(){
        $produts=Product::orderBy('id','desc')->get();
        return view('frontend.frontend',[
            'produts'=>$produts,
        ]);
    }

    function productdetails($slug){
        $product_details=Product::with('get_product_images')->where('slug',$slug)->first();
        $colors=ProductAttribute::where('product_id',$product_details->id)->get();
        $collection=collect($colors);
        $grouped=$collection->groupBy('color_id');
        return view('frontend.single_product',[
            'product_details'=>$product_details,
            'grouped'=>$grouped,
            'colors'=>$colors,
        ]);
        // return $slug;
    }

    function GetSize($id,$id2){
        $stringTOsend='';
        $sizes=ProductAttribute::where('product_id',$id2)->where('color_id',$id)->get();
        foreach ($sizes as $size) {
            $stringTOsend= $stringTOsend.'<input type="radio" name="size" value="'.$size->size_id.'">'.$size->get_size->name.'';
            // $stringTOsend= $stringTOsend.'<input type="radio" name="size" value="'.$size->$id.'">'.$size->get_size->name.'';
        }
        echo $stringTOsend;
    }

    function ShopCart(){
        $produts=Product::orderBy('id','desc')->get();
        $categories=Category::orderBy('id','asc')->get();
        return view('frontend.shop',[
            'produts'=>$produts,
            'categories'=>$categories,
        ]);
    }

}
