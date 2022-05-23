<?php

use App\Models\Cart;
use Illuminate\Support\Facades\Cookie;

function TotalCart(){
       return $carts=Cart::where('generet_cart_id',Cookie::get('cart_id'))->get();
    }
?>
