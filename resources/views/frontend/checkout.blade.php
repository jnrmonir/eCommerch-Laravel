@extends('frontend.master')
@section('content')
        <!-- .breadcumb-area start -->
        <div class="breadcumb-area bg-img-4 ptb-100">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="breadcumb-wrap text-center">
                            <h2>Checkout</h2>
                            <ul>
                                <li><a href="index.html">Home</a></li>
                                <li><span>Checkout</span></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- .breadcumb-area end -->
        <style>
            .color_red{
                color: red;
            }
            .StripeElement {
            box-sizing: border-box;

            height: 40px;

            padding: 10px 12px;

            border: 1px solid transparent;
            border-radius: 4px;
            background-color: white;

            box-shadow: 0 1px 3px 0 #e6ebf1;
            -webkit-transition: box-shadow 150ms ease;
            transition: box-shadow 150ms ease;
            }

            .StripeElement--focus {
            box-shadow: 0 1px 3px 0 #cfd7df;
            }

            .StripeElement--invalid {
            border-color: #fa755a;
            }

            .StripeElement--webkit-autofill {
            background-color: #fefde5 !important;
            }
            #card-element{
                width: 100%;
            }
        </style>
        <!-- checkout-area start -->
        <div class="checkout-area ptb-100">
            <div class="container">
                <div class="row">
                    <div class="col-lg-8">
                        <div class="checkout-form form-style">
                            <h3>Billing Details</h3>
                            <form action="{{ route('Payment') }}" method="post" id="payment-form">
                                @csrf
                                <div class="row">
                                    <div class="col-sm-6 col-12">
                                        <p>First Name <span class="color_red">*</span></p>
                                        <input name="first_name" type="text">
                                    </div>
                                    <div class="col-sm-6 col-12">
                                        <p>Last Name <span class="color_red">*</span></p>
                                        <input name="last_name" type="text">
                                    </div>
                                    <div class="col-12">
                                        <p>Compani Name</p>
                                        <input name="company_name" type="text">
                                    </div>
                                    <div class="col-sm-6 col-12">
                                        <p>Email Address <span class="color_red">*</span></p>
                                        <input name="email" type="email">
                                    </div>
                                    <div class="col-sm-6 col-12">
                                        <p>Phone No. <span class="color_red">*</span></p>
                                        <input name="phone" type="text">
                                    </div>
                                    <div class="col-sm-6 col-12">
                                        <p>Country <span class="color_red">*</span></p>
                                        <select name="country_id" id="country_id">
                                            <option value="1">Select a country</option>
                                            <option value="2">bangladesh</option>
                                            <option value="3">Algeria</option>
                                            <option value="4">Afghanistan</option>
                                            <option value="5">Ghana</option>
                                            <option value="6">Albania</option>
                                            <option value="7">Bahrain</option>
                                            <option value="8">Colombia</option>
                                            <option value="9">Dominican Republic</option>
                                        </select>
                                    </div>
                                    <div class="col-sm-6 col-12">
                                        <p>Town/City <span class="color_red">*</span></p>
                                        <select name="city_id" id="city_id">
                                            <option value="1">Select a town/city</option>
                                            <option value="2">bangladesh</option>
                                            <option value="3">Algeria</option>
                                            <option value="4">Afghanistan</option>
                                            <option value="5">Ghana</option>
                                            <option value="6">Albania</option>
                                            <option value="7">Bahrain</option>
                                            <option value="8">Colombia</option>
                                            <option value="9">Dominican Republic</option>
                                        </select>
                                    </div>

                                    <div class="col-sm-6 col-12">
                                        <p>Your Address <span class="color_red">*</span></p>
                                        <input name="address" type="text">
                                    </div>
                                    <div class="col-sm-6 col-12">
                                        <p>Postcode/ZIP</p>
                                        <input name="zipcode" type="text">
                                    </div>
                                    <div class="col-12">
                                        <p>Order Notes </p>
                                        <textarea name="note" placeholder="Notes about Your Order, e.g.Special Note for Delivery"></textarea>
                                    </div>
                                </div>

                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="order-area">
                            <h3>Your Order</h3>
                            <ul class="total-cost">
                                @php
                                    $sub_total=0;
                                @endphp
                                @foreach ($carts as $item)
                                <li>{{ $item->get_product->title }}<span class="pull-right">{{ $item->quantity }} x ${{ $item->get_product->price }}</span></li>
                                @php
                                    $sub_total += $item->get_product->price * $item->quantity
                                @endphp
                                @endforeach
                                <li>Subtotal <span class="pull-right"><strong>${{ $sub_total }}</strong></span></li>
                                <li>Shipping <span class="pull-right">Free</span></li>
                                <li>Discount({{ $discount_cookie }}%) <span class="pull-right">{{($sub_total * ($discount_cookie / 100))}}</span></li>
                                <li>Pay<span class="pull-right">${{ $sub_total - ($sub_total * ($discount_cookie / 100))}}</span></li>
                            </ul>
                            <ul class="payment-method">
                                <li>
                                    <input id="bank" value="bank" type="checkbox">
                                    <label for="bank">Direct Bank Transfer</label>
                                </li>
                                <li>
                                    <input id="paypal" value="paypal" type="radio" name="payment_method">
                                    <label for="paypal">Paypal</label>
                                </li>
                                <li>
                                    <input id="card" value="card" type="radio" name="payment_method">
                                    <label for="card">Credit Card</label>
                                </li>
                                <li>
                                    <input id="delivery" value="delivery" type="radio" name="payment_method">
                                    <label for="delivery">Cash on Delivery</label>
                                </li>
                            </ul>
                            <div id="cardPayment">
                                <div class="form-row">
                                <label for="card-element">
                                  Credit or debit card
                                </label>
                                <div id="card-element">
                                  <!-- A Stripe Element will be inserted here. -->
                                </div>

                                <!-- Used to display form errors. -->
                                <div id="card-errors" role="alert"></div>
                                 </div>
                            </div>
                            <button id="placeOrder" type="submit">Place Order</button>
                        </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- checkout-area end -->
@endsection

@section('footer_js')
     <script src="//js.stripe.com/v3/"></script>
    <script>
        $(document).ready(function(){
            $('#cardPayment').hide();
            $('#placeOrder').hide();
            $('#paypal').click(function(){
                $('#cardPayment').hide();
                $('#placeOrder').show();
            })
            $('#card').click(function(){
                $('#cardPayment').show();
                $('#placeOrder').show();
                
        // Create a Stripe client.
        var stripe = Stripe('pk_test_51HjnuNBgopSPGpL4wDFRV9wMnLianjWQOF2iuXslBjuLEfiyk7bx0rrWA3FoWvYLQ5chew2fVWq10VKlSo0vcce800qZpcn3kj');

        // Create an instance of Elements.
        var elements = stripe.elements();

        // Custom styling can be passed to options when creating an Element.
        // (Note that this demo uses a wider set of styles than the guide below.)
        var style = {
        base: {
            color: '#32325d',
            fontFamily: '"Helvetica Neue", Helvetica, sans-serif',
            fontSmoothing: 'antialiased',
            fontSize: '16px',
            '::placeholder': {
            color: '#aab7c4'
            }
        },
        invalid: {
            color: '#fa755a',
            iconColor: '#fa755a'
        }
        };

        // Create an instance of the card Element.
        var card = elements.create('card', {style: style});

        // Add an instance of the card Element into the `card-element` <div>.
        card.mount('#card-element');

        // Handle real-time validation errors from the card Element.
        card.on('change', function(event) {
        var displayError = document.getElementById('card-errors');
        if (event.error) {
            displayError.textContent = event.error.message;
        } else {
            displayError.textContent = '';
        }
        });

        // Handle form submission.
        var form = document.getElementById('payment-form');
        form.addEventListener('submit', function(event) {
        event.preventDefault();

        stripe.createToken(card).then(function(result) {
            if (result.error) {
            // Inform the user if there was an error.
            var errorElement = document.getElementById('card-errors');
            errorElement.textContent = result.error.message;
            } else {
            // Send the token to your server.
            stripeTokenHandler(result.token);
            }
        });
        });

        // Submit the form with the token ID.
        function stripeTokenHandler(token) {
        // Insert the token ID into the form so it gets submitted to the server
        var form = document.getElementById('payment-form');
        var hiddenInput = document.createElement('input');
        hiddenInput.setAttribute('type', 'hidden');
        hiddenInput.setAttribute('name', 'stripeToken');
        hiddenInput.setAttribute('value', token.id);
        form.appendChild(hiddenInput);

        // Submit the form
        form.submit();
        }
            })
        })

    </script> 
@endsection
