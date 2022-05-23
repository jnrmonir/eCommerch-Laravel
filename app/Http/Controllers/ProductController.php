<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Category;
use App\Models\Color;
use App\Models\SubCategory;
use App\Models\ProductAttribute;
use App\Models\ProductImages;
use App\Models\Size;
use Illuminate\Support\Facades\File;
use Image;

class ProductController extends Controller
{

    function productlist(){
        return view('backend.product.product_list',[
            'products'=>Product::paginate(10),
            'count'=>Product::count(),

        ]);
    }
    function productadd(Request $request){
        $cat=Category::all();
        $scat=SubCategory::all();
        $colors=Color::all();
        return view('backend.product.productCat_add',compact('cat','scat','colors'));
    }
    function ProductPost(Request $request){

        // $request->validate([
        //     'title'=>['required'],
        //     // 'thumbnail'=> ['required','image']
        // ]);

            $slug_check=Product::where('slug',Str::slug($request->title))->count();
            if($slug_check>0){
                $slug=Str::slug($request->title).'-'.Str::random(2);
            }
            else{
                $slug=Str::slug($request->title);
            }

        if($request->hasFile('thumbnail')){
            $upload_image=$request->file('thumbnail');
            $ext=Str::slug($request->title).'.'. $upload_image->getClientOriginalExtension();
            Image::make($upload_image)->save(public_path('product/thumbnail/'.$ext));

            $product_id=Product::insertGetId([
                'category_id'=>$request->category_id,
                'subcategory_id'=>$request->subcategory_id,
                'title'=>$request->title,
                'slug'=>$slug,
                'summary'=>$request->summary,
                'description'=>$request->description,
                'price'=>$request->price,
                'thumbnail'=>$ext,
                // 'quantity'=>$request->quantity,
                'created_at'=>Carbon::now(),
                ]);

        foreach($request->color_id as $key=>$color){
            ProductAttribute::insert([
                'product_id'=>$product_id,
                'color_id'=>$color,
                'size_id'=>$request->size_id[$key],
                'quantity'=>$request->quantity[$key],
            ]);
            }

            $image_path=public_path('product/images/'.$product_id);
            File::makeDirectory($image_path, $mode=0777, true, true);

            // Multi Images insert code
            // if($request->hasFile('images')){
            $upload_image=$request->file('images');
            foreach ($upload_image as $images) {
                $ext=Str::random(5).'.'.$images->getClientOriginalExtension();
                Image::make($images)->save($image_path.'/'.$ext);
                ProductImages::insert([
                                'product_id'=>$product_id,
                                'images'=>$ext,
                                'created_at'=>Carbon::now(),
                            ]);

            }
        }


        else{
            $product_id=Product::insertGetId([
                'category_id'=>$request->category_id,
                'subcategory_id'=>$request->subcategory_id,
                'title'=>$request->title,
                'slug'=>Str::slug($request->title),
                'summary'=>$request->summary,
                'description'=>$request->description,
                'price'=>$request->price,
                // 'created_at'=>Carbon::now(),
                ]);

        foreach($request->color_id as $key=>$color){
            ProductAttribute::insert([
                'product_id'=>$product_id,
                'color_id'=>$color,
                'size_id'=>$request->size_id[$key],
                'quantity'=>$request->quantity[$key],
            ]);
            }
            $image_path=public_path('product/images/'.$product_id);
            File::makeDirectory($image_path, $mode=0777, true, true);

            // Multi Images insert code
            // if($request->hasFile('images')){
            $upload_image=$request->file('images');
            foreach ($upload_image as $images) {
                $ext=Str::random(5).'.'.$images->getClientOriginalExtension();
                Image::make($images)->save($image_path.'/'.$ext);
                ProductImages::insert([
                                'product_id'=>$product_id,
                                'images'=>$ext,
                                'created_at'=>Carbon::now(),
                            ]);

            }
        }


        return back();
    }

    function ProductDelete($id){
        $product=Product::findOrFail($id);
        if(file_exists(public_path('product/thumbnail/'.$product->thumbnail))){
            unlink(public_path('product/thumbnail/'.$product->thumbnail));
        }
        $images=ProductImages::where('product_id',$product->id)->get();
        foreach ($images as $key => $value) {
            $value->delete();
        }
        File::deleteDirectory(public_path('product/images/'.$product->id));
        $product->delete();
        return back();
    }
    // single image deleted
    function ProductImageDelete($id){
        $images=ProductImages::findOrFail($id);
        $path=(public_path('product/images/'.$images->product_id.'/'.$images->images));
        if(file_exists($path)){
            unlink($path);
        }
        $images->delete();
        return back();
    }

    function ProductEdit($id){
        $products=Product::findOrFail($id);
        $cat=Category::orderBy('category_name', 'asc')->get();
        $scat=SubCategory::all();
        $colors=Color::orderBy('color_name', 'asc')->get();
        $sizes=Size::orderBy('name', 'asc')->get();
        return view('backend.product.product_edit',[
            'products'=>$products,
            'cat'=>$cat,
            'scat'=>$scat,
            'colors'=>$colors,
            'sizes'=>$sizes
        ]);
    }

    function ProductUpdate(Request $request){

        $slug_check=Product::where('slug',Str::slug($request->title))->count();
            if($slug_check>0){
                $slug=Str::slug($request->title).'-'.Str::random(2);
            }
            else{
                $slug=Str::slug($request->title);
            }

            $id= $request->id;
            $product=Product::findOrFail($id);
            if($request->hasFile('thumbnail')){
                $upload_image=$request->file('thumbnail');


            $path=public_path('product/thumbnail/'.$product->thumbnail);
            if(file_exists($path)){
                unlink($path);
            }

            $ext=Str::slug($request->title).'.'. $upload_image->getClientOriginalExtension();
            Image::make($upload_image)->save(public_path('product/thumbnail/'.$ext));

        $product->update([
            'category_id'=>$request->category_id,
            'subcategory_id'=>$request->subcategory_id,
            'title'=>$request->title,
            'slug'=>$slug,
            'summary'=>$request->summary,
            'description'=>$request->description,
            'price'=>$request->price,
            'thumbnail'=>$ext,
            'updated_at'=>Carbon::now(),
            ]);

    foreach($request->attribute_id as $key => $aid){
        ProductAttribute::findOrFail($aid)->update([
            'product_id'=>$id,
            'color_id'=>$request->color_id[$key],
            'size_id'=>$request->size_id[$key],
            // 'quantity'=>$request->quantity[$key],
        ]);
        }

        $image_path=public_path('product/images/'.$id);
        File::makeDirectory($image_path, $mode=0777, true, true);

        // Multi Images insert code
        // if($request->hasFile('images')){
        $upload_image=$request->file('images');
        foreach ($upload_image as $images) {
            $ext=Str::random(5).'.'.$images->getClientOriginalExtension();
            Image::make($images)->save($image_path.'/'.$ext);
            ProductImages::insert([
                            'product_id'=>$id,
                            'images'=>$ext,
                            'created_at'=>Carbon::now(),
                        ]);

        }
    }
        return redirect(route('productlist'));
    }

    function GetAjaxSubCategory($id){
        $scat=SubCategory::where('category_id',$id)->get();
        return response()->json($scat);
    }
}
