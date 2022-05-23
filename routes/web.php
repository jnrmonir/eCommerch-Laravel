<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\SocialController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });
// Route::redirect('/', 'login', 301);  //eta hocce sorasori login page ee jabe.

// Route::get('contact',function(){
// 	$data="!HELLO WORD";
// 	return view('contact',compact('data'));
// });
Route::get('contact-us','TestController@contact');
Route::get('demo','TestController@demo');

Auth::routes(['verify' => true]);

Route::get('/dashboard', 'DashboardController@dashboard')->name('dashboard');
Route::get('/home', 'DashboardController@dashboard')->name('home');
//Category
Route::get('/category', 'CategoryController@index')->name('category');
Route::get('/category/add', 'CategoryController@CategoryAdd')->name('CategoryAdd');
Route::post('/category/post', 'CategoryController@CategoryPost')->name('CategoryPost');
Route::get('/category/delete/{cat_id}', 'CategoryController@CategoryDelete')->name('CategoryDelete');
Route::get('/category/trash', 'CategoryController@CategoryTrashed')->name('CategoryTrashed');
Route::get('/category/edit/{cat_id}', 'CategoryController@CategoryEdit')->name('CategoryEdit');
Route::post('/category/update', 'CategoryController@CategoryUpdate')->name('CategoryUpdate');
Route::get('/category/restore/{cat_id}', 'CategoryController@CategoryRestore')->name('CategoryRestore');
Route::get('/category/permanent/{cat_id}', 'CategoryController@CategoryPermanent')->name('CategoryPermanent');

// subcategory
Route::get('/subcategory', 'SubCategoryController@index')->name('subcategory');
Route::get('/subcategory/add', 'SubCategoryController@SubCategoryAdd')->name('SubCategoryAdd');
Route::post('/subcategory/post', 'SubCategoryController@SubCategoryPost')->name('SubCategoryPost');
Route::get('/subcategory/delete/{cat_id}', 'SubCategoryController@SubCategoryDelete')->name('SubCategoryDelete');
Route::get('/subcategory/trash', 'CategoryController@SubCategoryTrashed')->name('SubCategoryTrashed');
Route::get('/subcategory/edit/{cat_id}', 'SubCategoryController@SubCategoryEdit')->name('SubCategoryEdit');
Route::post('/subcategory/update', 'CategoryController@SubCategoryUpdate')->name('SubCategoryUpdate');

// Product
Route::get('subcategory/get-ajax-list/{id}', 'ProductController@GetAjaxSubCategory')->name('GetAjaxSubCategory');
Route::get('/product/list', 'ProductController@productlist')->name('productlist');
Route::get('/product/add', 'ProductController@productadd')->name('productadd');
Route::get('/product/delete/{id}', 'ProductController@ProductDelete')->name('ProductDelete');
Route::get('/product/edit/{id}', 'ProductController@ProductEdit')->name('ProductEdit');
Route::get('/product/single/image/delete/{id}', 'ProductController@ProductImageDelete')->name('ProductImageDelete');
Route::get('/product/trash', 'ProductController@ProductTrashed')->name('ProductTrashed');
Route::post('/product/post', 'ProductController@ProductPost')->name('ProductPost');
Route::post('/product/update', 'ProductController@ProductUpdate')->name('ProductUpdate');

// Orders
Route::get('/orders', 'DashboardController@Order')->name('Order');
Route::get('/orders/excel/download', 'DashboardController@ExportExcel')->name('ExportExcel');

//Show Product in FrontEnd
Route::get('/', 'FrontendController@FrontPage')->name('FrontPage');
Route::get('/product/{slug}', 'FrontendController@productdetails')->name('productdetails');
Route::get('product/get/size/{color_id}/{product_id}','FrontendController@GetSize')->name('colorId');
Route::get('shop','FrontendController@ShopCart')->name('ShopCart');


Route::get('cart/', [CartController::class,'cart'])->name('cart'); //Route of laravel 8
Route::get('cart/{coupon_code}', [CartController::class,'cart'])->name('CouponCode'); //Route of laravel 8
Route::post('cart/update', [CartController::class,'CartUpdate'])->name('CartUpdate'); //Route of laravel 8
Route::get('single/cart/{product_id}/', [CartController::class,'SingleCart'])->name('SingleCart');
Route::post('cartpost/', [CartController::class,'CartPost'])->name('CartPost');
Route::get('single/cart/delete/{product_id}/', [CartController::class,'SingleCartDelete'])->name('SingleCartDelete');
Route::get('checkout','CheckoutController@Checkout')->name('Checkout');
Route::post('payment','PaymentController@Payment')->name('Payment');
Route::get('status/','PaymentController@status')->name('status');

Route::get('role/permission','RoleController@RoleManager')->name('RoleManager');
Route::post('role/add-to/permission','RoleController@RoleAddToPermission')->name('RoleAddToPermission');
Route::post('user/add-to/role','RoleController@UserAddToRole')->name('UserAddToRole');
Route::get('edit/user/permission/{user_id}',[RoleController::class,'EditUserPermission'])->name('EditUserPermission');
Route::post('edit/user/permission',[RoleController::class,'PermissionEditPost'])->name('PermissionEditPost');

Route::get('login/github', [SocialController::class, 'redirectToProvider'])->name('githublogin');
Route::get('login/github/callback', [SocialController::class, 'handleProviderCallback'])->name('githubcallback');

Route::get('login/google', [SocialController::class, 'googleredirectToProvider'])->name('googlelogin');
Route::get('login/google/callback', [SocialController::class, 'googlehandleProviderCallback'])->name('googlecallback');

Route::resource('blog', 'BlogController');


