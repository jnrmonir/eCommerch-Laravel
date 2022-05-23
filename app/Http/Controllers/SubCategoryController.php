<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\SubCategory;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class SubCategoryController extends Controller
{
    function index(){
        $subcategories=SubCategory::paginate(10);
        $categories=Category::orderBy('category_name','asc')->get();
        return view('backend.subcategory.subcategory',compact('subcategories','categories'));
    }
    function SubCategoryAdd(){
        $categories=Category::orderBy('category_name','asc')->get();
        return view('backend.subcategory.subcategory_add',compact('categories'));
    }
    function SubCategoryPost(Request $request){
        $request->validate([
            'category_id'=>('required'),
            'subcategory_name'=>('required'),
        ]);
        SubCategory::insert([
            'subcategory_name'=>$request->subcategory_name,
            'category_id'=>$request->category_id,
            'slug'=> Str::slug($request->subcategory_name),
            'created_at'=>Carbon::now(),
        ]);
        return back()->with ('add','Sub Category Added Successfully');
    }
    function SubCategoryDelete($id){
        SubCategory::findorFail($id)->delete();
        return back()->with ('delete','Sub Category Deleted Successfully');
    }
    function SubCategoryEdit($id){
        $subcategories=SubCategory::with('get_category')->paginate(10);
        $scats=SubCategory::findOrFail($id);
        $categories=Category::orderBy('category_name','asc')->get();
        return view('backend.subcategory.subcategory_edit',compact('subcategories','scats','categories'));

    }
    function SubCategoryUpdate(Request $request){
    $cat=SubCategory::findorFail($request->subcategory_id);
    $cat->subcategory_name= $request->name;
    $cat->category_id=$request->category_id;
    $cat->save();
    return back()->with ('delete','Category Update Successfully');
    }
}
