<?php

namespace App\Http\Controllers;

use App\Mail\OrderShipped;
use App\Models\Cart;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Mail;
use PDF;
use Session;

class CheckoutController extends Controller
{
    function __construct()
    {
        $this->middleware('auth');
    }
    function Checkout(Request $request){

        $order = Order::findOrFail(83);
        Mail::to('laraveltest30@gmail.com')->send(new OrderShipped($order));


        die('Sent');

        // $data["client_name"]='Monir';
        // $data["subject"]='Hello Khan';

        // $pdf = PDF::loadView('welcome', $data);
        // Mail::send('welcome',$data,function($message) use ($data,$pdf){
        //     $message->from('sender@domain.net');
        //     $message->to('laraveltest30@gmail.com',$data["client_name"])
        //     ->subject($data["subject"])
        //     ->attachData($pdf->output(), "invoice.pdf");
        // });
        // return "ok";

        $value=$request->session()->get('coupon');
        $discount_cookie = Cookie::get('coupon_discount');
        $old_cookie_id = Cookie::get('cart_id');
        $carts = Cart::where('generet_cart_id', $old_cookie_id)->get();
        return view('frontend.checkout',[
            'discount_cookie'=>$discount_cookie,
            'carts'=>$carts,
        ]);
    }
}
