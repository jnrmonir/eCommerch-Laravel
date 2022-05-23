<?php

namespace App\Http\Controllers;

use App\Models\Coupon;
use App\Models\Cart;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Str;

class CartController extends Controller
{
    function SingleCart($id)
    {
        $old_cookie_id = Cookie::get('cart_id'); //Data get from Browser by Cookies

        // return Cart::where('generate_cart_id', $old_cookie_id)->get(); Get all data by my browser cookies ID
        if ($old_cookie_id) {
            $generate = $old_cookie_id;
        } else {
            $generate = Str::random(7) . rand(1, 1000);
            Cookie::queue('cart_id', $generate, 10080);
        }

        if (Cart::where('generet_cart_id', $generate)->where('product_id', $id)->exists()) {
            Cart::where('generet_cart_id', $generate)->where('product_id', $id)->increment('quantity');
        } else {
            $cart = new Cart;
            $cart->product_id = $id;
            $cart->generet_cart_id = $generate;
            $cart->save();
        }

        // if($old_cookie_id){
        //     $cart = new Cart;
        //     $cart->product_id = $id;
        //     $cart->generate_cart_id = $old_cookie_id;
        //     $cart->save();
        //     }
        // else{
        //     $generate = Str::random(7).rand(1, 1000);

        //     $cart = new Cart;
        //     $cart->product_id = $id;
        //     $cart->generate_cart_id = $generate;
        //     $cart->save();
        //     Cookie::queue('cart_id', $generate , 10080);
        // }
        // $cart = new Cart;
        //     $cart->product_id = $id;
        //     $cart->generate_cart_id = $generate;
        //     $cart->save();

        // Cookie::queue('cart_id', , 10080);
        return back();
    }

    function cart($code = '', Request $request) // $code chara onno jekono naaam hote pare
    {

        if ($code == '') {
            $discount = 0;
            $old_cookie_id = Cookie::get('cart_id');

            $carts = Cart::where('generet_cart_id', $old_cookie_id)->get();
            return view('frontend.cart', [
                'carts' =>  $carts,
                'discount' => $discount
            ]);
        } else {

            $coupon_code = Coupon::where('coupon_code', $code)->exists();
            if ($coupon_code) {
                $current_validity = Coupon::where('coupon_code', $code)->first()->validity;
                if (Carbon::now()->format('Y-m-d') <= $current_validity) {

                    $discount = Coupon::where('coupon_code', $code)->first()->discount;
                    $old_cookie_id = Cookie::get('cart_id');

                    $carts = Cart::where('generet_cart_id', $old_cookie_id)->get();
                    Cookie::queue('coupon_discount', $discount, 10080);
                    session(['coupon' => $discount]);
                    return view('frontend.cart', [
                        'carts' =>  $carts,
                        'discount' => $discount
                    ]);
                } else {
                    $discount = 0;
                    $old_cookie_id = Cookie::get('cart_id');

                    $carts = Cart::where('generet_cart_id', $old_cookie_id)->get();
                    // $value = $request->session()->get('message');
                    return view('frontend.cart', [
                        'carts' =>  $carts,
                        'discount' => $discount,
                        // 'value' => $value
                    ]);
                }
                // Coupon::where('validity','<=' )->
            } else {
                return 'Not found';
            }
            $discount = 0;
            $old_cookie_id = Cookie::get('cart_id');

            $carts = Cart::where('generet_cart_id', $old_cookie_id)->get();
            return view('frontend.cart', [
                'carts' =>  $carts,
                'discount' => $discount
            ]);
        }
    }

    function SingleCartDelete($id)
    {
        Cart::findOrFail($id)->delete();
        return back();
    }

    function CartUpdate(Request $request)
    {

        foreach ($request->cart_id as $key => $item) {
            Cart::findOrFail($item)->update([
                'quantity' => $request->quantity[$key],
                'updated_at' => Carbon::now(),
            ]);
        }
        // return $request->all();
        return back();
    }

    // function CouponCode($code){

    //     if(Coupon::where('coupon_code', $code)->exists()){
    //         return "Oi Beta! Coupon to ache";
    //     }
    //     else{
    //         return "Oi beta! Coupon Nai";
    //     }
    // }

    function CartPost(Request $request){
        $old_cookie_id = Cookie::get('cart_id'); //Data get from Browser by Cookies

        // return Cart::where('generate_cart_id', $old_cookie_id)->get(); Get all data by my browser cookies ID
        if ($old_cookie_id) {
            $generate = $old_cookie_id;
        } else {
            $generate = Str::random(7) . rand(1, 1000);
            Cookie::queue('cart_id', $generate, 10080);
        }

        if (Cart::where('generet_cart_id', $generate)->where('product_id',$request->product)->where('color_id', $request->color)->where('size_id', $request->size)->exists()) {
            Cart::where('generet_cart_id', $generate)->where('product_id', $request->product)->where('color_id', $request->color)->where('size_id', $request->size)->increment('quantity',$request->quantity);
        } else {
            $cart = new Cart;
            $cart->product_id = $request->product;
            $cart->generet_cart_id = $generate;
            $cart->color_id = $request->color;
            $cart->size_id = $request->size;
            $cart->save();
        }
        return "Ok";
    }
}
