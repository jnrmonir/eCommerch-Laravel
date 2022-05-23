<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\SubCategory;
use Carbon\Carbon;
use Illuminate\Http\Request;

class CategoryController extends Controller{

    function __construct(){
        $this->middleware('auth');
    }

    function index(){
        // $categories = Category::all();
        $categories = Category::paginate(10);
        $count = Category::count();
        return view('/backend.category.category', compact('categories','count'));
    }
    function CategoryAdd(){
        return view('/backend.category.category_add');
    }

    function CategoryPost(Request $request){
        $request->validate([
            'category_name'=>['required','unique:categories'],
            'slug'=>['required'],
         ]//,
        // [
        //     'name.required'=>'Please insert name',
        // ]
    );

        $cat= new Category;
        $cat->category_name= $request->category_name;
        $cat->slug= $request->slug;
        $cat->save();
        // Category::insert([
        //     'category_name'=>$request->name,
        //     'slug'=>$request->slug,
        //     'created_at'=>Carbon::now('Asia/Dhaka'),
        // ]);
        return back()->with('insert','Category Added Succesfully');
    	// return $request->all();
        // return $request->category_name;
    }
    public function CategoryDelete($id){
        $cat=Category::findorFail($id);
        $catProduct_count=Product::where('category_id', $cat->id)->count();
        if ($catProduct_count>0) {
            return back()->with("deleted", "You can not deleted category because you have"." ".$catProduct_count." "."product");
        } else { 
            // Category::where('slug',$id)->delete();
            // Category::where('id',$id)->delete();
            $scat=SubCategory::where('category_id', $id)->get();
            foreach ($scat as $value) {
                $value->delete();
            }
            // $cat=Category::findorFail($id)->delete();
            $cat->delete();
            return back()->with('success', 'Category Deleted Successfully');
            // return redirect('/'); //home page ee cole jabe
        }
    }
    function CategoryTrashed(){
        $count = Category::count();
        $delete_cat = Category::onlyTrashed()->paginate(10);
        return view('backend.category.category_trash',compact('count','delete_cat'));
    }

    function CategoryEdit($id){
        return view('backend.category.category_edit',[
            'categories' => Category::paginate(10),
            'cats'=>Category::findorFail($id),
            // 'cats'=>Category::where('slug',$id)->first(), //ekhane 'slug' hocce url er jonne
        ]);
    }

    function CategoryUpdate(Request $request){
        // Category::findorFail($request->category_id)->update([
        //     'category_name'=>$request->name,
        //     'slug'=>$request->slug,
        //     'updated_at'=>Carbon::now(),
        // ]);
        $cat=Category::findorFail($request->category_id);
        $cat->category_name= $request->name;
        $cat->slug= $request->slug;
        $cat->save();
        return back()->with ('delete','Category Update Successfully');
    }
    function CategoryRestore($id){

        Category::withTrashed()->findOrFail($id)->restore();
        return back();
    }
    function CategoryPermanent($id){
        Category::onlyTrashed()->findOrFail($id)->forceDelete();
        return back();
    }
}

