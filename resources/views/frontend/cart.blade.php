@extends('frontend.master')
@section('title')
    Cart Page || Web Solutions Ltd
@endsection
@section('cart')
    active
@endsection
@section('content')
    <!-- .breadcumb-area start -->
    <div class="breadcumb-area bg-img-4 ptb-100">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="breadcumb-wrap text-center">
                        <h2>Shopping Cart</h2>
                        <ul>
                            <li><a href="index.html">Home</a></li>
                            <li><span>Shopping Cart</span></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- .breadcumb-area end -->
    <!-- cart-area start -->
    <div class="cart-area ptb-100">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <form action="{{ route('CartUpdate') }}" method="post">
                        @csrf

                        <table class="table cart-wrap">
                            <thead>
                                <tr>
                                    <th class="images">Image</th>
                                    <th class="product">Product</th>
                                    <th class="ptice">Price</th>
                                    <th class="ptice">Color & Size</th>
                                    <th class="quantity">Quantity</th>
                                    <th class="total">Total</th>
                                    <th class="remove">Remove</th>
                                </tr>
                            </thead>
                            <tbody>
                            	@php
                            		$total = 0;
                            	@endphp
                                @forelse ($carts as $cart)

                                    <tr>
                                        <input type="hidden" value="{{ $cart->id }}" name="cart_id[]">
                                        <td class="images"><img
                                                src="{{ asset('product/thumbnail/' . $cart->get_product->thumbnail) }}" alt=" ">
                                        </td>
                                        <td class="product"><a
                                                href="{{ route('productdetails', $cart->get_product->slug) }}">{{ $cart->get_product->title }}</a>
                                        </td>
                                        <td class="ptice unit_price{{ $cart->id }}"
                                            data-unit{{ $cart->id }}="{{ $cart->get_product->price }}">${{ $cart->get_product->price }}
                                        </td>
                                        <td class="ptice unit_price">Color: red Size: m l</td>
                                        <td class="quantity cart-plus-minus">
                                            <input type="text" min="1" name="quantity[]" class="cart_quantity{{ $cart->id }}"
                                                id="cart_quantity" value="{{ $cart->quantity }}" />
                                            <div class="dec qtybutton qtyminus{{ $cart->id }}">-</div>
                                            <div class="inc qtybutton qtyplus{{ $cart->id }}">+</div>
                                        </td>
                                        <td class="total_Unit{{ $cart->id }}">$ {{ $cart->quantity * $cart->get_product->price }}

                                        	@php
                                        		$total += $cart->quantity * $cart->get_product->price;
                                        	@endphp
                                        </td>
                                        <td class="remove"><a href="{{ route('SingleCartDelete', $cart->id) }}"><i
                                                    class="fa fa-times"></i></a></td>
                                    </tr>

                                @empty
                                    <tr>
                                        <td colspan="10">No Added Product Yet</td>
                                    </tr>
                                @endforelse

                            </tbody>
                        </table>
                        <div class="row mt-60">
                            <div class="col-xl-4 col-lg-5 col-md-6 ">
                                <div class="cartcupon-wrap">
                                    <ul class="d-flex">
                                        <li>
                                            <button>Update Cart </button>
                                        </li>
                                        <li><a href="{{ route('ShopCart') }}">Continue Shopping</a></li>
                                    </ul>
                                    <h3>Cuopon</h3>
                                    <p>Enter Your Coupon Code ukyuif You Have One</p>

                                    <div class="cupon-wrap">

                                        <input type="text" class="coupon_code" placeholder="Coupon Code">
                                        <button type="button" class="coupon_button">Apply Coupon</button>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-3 offset-xl-5 col-lg-4 offset-lg-3 col-md-6">
                                <div class="cart-total text-right">
                                    <h3>Cart Totals</h3>
                                    <ul>
                                        <li><span class="pull-left">Subtotal </span>${{ $total}}</li>
                                        <li><span class="pull-left">Discount(%) </span>{{ $discount }}</li>
                                        <li><span class="pull-left"> Total </span><span class="totalprice">${{ $total - ($total * ($discount / 100))}}</span>
                                        </li>
                                    </ul>
                                    <a href="{{ route('Checkout') }}">Proceed to Checkout</a>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- cart-area end -->
@endsection
@section('footer_js')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<script>
        $(document).ready(function(){
            @foreach($carts as $c)
            $('.qtyplus{{ $c->id }}').click(function(){
                let cart_quantity = $('.cart_quantity{{ $c->id }}').val();
                let unit_price = $('.unit_price{{ $c->id }}').attr('data-unit{{$c->id}}');
                let Qty = parseFloat(cart_quantity) + 1;
                let newQty = $('.cart_quantity{{ $c->id }}').val(Qty);
                // let unit_total = unit_price * newQty;
                $('.total_Unit{{$c->id}}').html('$' + $('.cart_quantity{{ $c->id }}').val() * unit_price);

            });

            $('.qtyminus{{ $c->id }}').click(function(){
                let cart_quantity = $('.cart_quantity{{ $c->id }}').val();
                if(cart_quantity != 1){
                    let unit_price = $('.unit_price{{ $c->id }}').attr('data-unit{{$c->id}}');
                    let Qty = parseFloat(cart_quantity) - 1;
                    let newQty = $('.cart_quantity{{ $c->id }}').val(Qty);
                    // let unit_total = unit_price * newQty;
                    $('.total_Unit{{$c->id}}').html('$' + $('.cart_quantity{{ $c->id }}').val() * unit_price);
                }
            });

            @endforeach


            // Coupon JS

            $('.coupon_button').click(function(){
               let coupon = $('.coupon_code').val();
                window.location.href = "{{ url('cart') }}"+ "/"+ coupon;
            });
        });
        </script>
@endsection
