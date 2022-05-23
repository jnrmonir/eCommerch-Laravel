<?php

namespace App\Http\Controllers;

use App\Mail\OrderShipped;
use App\Models\Cart;
use App\Models\Order;
use App\Models\ProductAttribute;
use App\Models\Shipping;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Mail;
use PDF;
use PayPal\Rest\ApiContext;
use PayPal\Auth\OAuthTokenCredential;
use PayPal\Api\Payer;
use PayPal\Api\Item;
use PayPal\Api\ItemList;
use PayPal\Api\Amount;
use PayPal\Api\Transaction;
use PayPal\Api\RedirectUrls;
use PayPal\Api\Payment;
use Session;

class PaymentController extends Controller
{
    function __construct()
    {
         /** PayPal api context **/
         $paypal_conf = \Config::get('paypal');
         $this->_api_context = new ApiContext(new OAuthTokenCredential(
             $paypal_conf['client_id'],
             $paypal_conf['secret'])
         );
         $this->_api_context->setConfig($paypal_conf['settings']);

        $this->middleware('auth');
    }

    function Payment(Request $request){
        $old_cookie_id = Cookie::get('cart_id');
        $carts = Cart::where('generet_cart_id', $old_cookie_id)->get();
        $total_amount=0;
        foreach($carts as $cart){
          $total_amount += $cart->get_product->price * $cart->quantity;
        }
        if($request->payment_method=='card'){
           
            $shipping=new Shipping();
            $shipping->user_id=Auth::id();
            $shipping->first_name=$request->first_name;
            $shipping->last_name=$request->last_name;
            $shipping->company_name=$request->company_name;
            $shipping->email=$request->email;
            $shipping->phone=$request->phone;
            $shipping->country_id=$request->country_id;
            $shipping->city_id=$request->city_id;
            $shipping->zipcode=$request->zipcode;
            $shipping->address=$request->address;
            $shipping->total_amount=$total_amount;
            $shipping->coupon_code=$request->coupon_code;
            $shipping->coupon_discount=$request->coupon_discount;
            $shipping->note=$request->note;
            $shipping->save();

            foreach ($carts as $ca) {
                $order=new Order();
                $order->shipping_id=$shipping->id;
                $order->product_id=$ca->product_id;
                $order->quantity=$ca->quantity;
                $order->product_unit_price=$ca->get_product->price;
                $order->save();
                ProductAttribute::where('product_id',$ca->product_id)->where('color_id',  $ca->color_id)->where('size_id', $ca->size_id)->decrement('quantity',$ca->quantity);
                $ca->delete();
            }
            $stripe = \Stripe\Stripe::setApiKey("sk_test_51HjnuNBgopSPGpL4zMgmyYfUGf9CSoLcvB6C1bq6wj3ZhCkVLGp7sYGNZZUJm0rgtVS1IhVtximvVssnJqALXbEn00z6059LXJ");
            $charge = \Stripe\Charge::create([
            'amount' => $total_amount * 100,
            'currency' => 'usd',
            'source' => $request->stripeToken, // obtained with Stripe.js
            'description' => 'My First Test Charge (created for API docs)'
            ]);
            $shipe=Shipping::findOrFail($shipping->id);
            $shipe->payment_status=2;
            $shipe->save();

            $data=Order::where('shipping_id',$shipping->id)->get();

            // $pdf = PDF::loadView('welcome', $data);
            // Mail::send('welcome',$data,function($message) use ($data,$pdf){
            //     $message->to('laraveltest30@gmail.com')
            //     ->subject('Hello Khan')
            //     ->attachData($pdf->output(), "invoice.pdf");
            // });
            Mail::to(Auth::user()->email)->send(new OrderShipped($data));

            return "payment done";
        }
        elseif($request->payment_method=='paypal'){
        
            $payer = new Payer();
        $payer->setPaymentMethod('paypal');

        $item_1 = new Item();

        $item_1->setName('Item 1') /** item name **/
            ->setCurrency('USD')
            ->setQuantity(1)
            ->setPrice(500); /** unit price **/

        $item_list = new ItemList();
        $item_list->setItems(array($item_1));

        $amount = new Amount();
        $amount->setCurrency('USD')
            ->setTotal(500);

        $transaction = new Transaction();
        $transaction->setAmount($amount)
            ->setItemList($item_list)
            ->setDescription('Your transaction description');

        $redirect_urls = new RedirectUrls();
        $redirect_urls->setReturnUrl(route('status')) /** Specify return URL **/
            ->setCancelUrl(route('status'));

        $payment = new Payment();
        $payment->setIntent('Sale')
            ->setPayer($payer)
            ->setRedirectUrls($redirect_urls)
            ->setTransactions(array($transaction));
        /** dd($payment->create($this->_api_context));exit; **/
        try {

            $payment->create($this->_api_context);

        } catch (\PayPal\Exception\PPConnectionException $ex) {

            if (\Config::get('app.debug')) {

                \Session::put('error', 'Connection timeout');
                return redirect(route('paywithpaypal'));

            } else {

                \Session::put('error', 'Some error occur, sorry for inconvenient');
                // return redirect(route('paywithpaypal'));
                return "Some error occur, sorry for inconvenient";

            }

        }

        foreach ($payment->getLinks() as $link) {

            if ($link->getRel() == 'approval_url') {

                $redirect_url = $link->getHref();
                break;

            }

        }

        /** add payment ID to session **/
        Session::put('paypal_payment_id', $payment->getId());

        if (isset($redirect_url)) {

            /** redirect to paypal **/
            return redirect(away($redirect_url));

        }

        \Session::put('error', 'Unknown error occurred');
        // return Redirect::route('paywithpaypal');
        return "Unknown error occurred";

            return "Paypal";
        }
        elseif($request->payment_method=='bank'){
            return "Bank";
        }
        else{
            return "Delivary";
        }
        return "ok";

        // $shipping=new Shipping();
        // $old_cookie_id = Cookie::get('cart_id');
        // $carts = Cart::where('generet_cart_id', $old_cookie_id)->get();
        // $total_amount=0;
        // foreach($carts as $cart){
        //   $total_amount += $cart->get_product->price * $cart->quantity;
        // }

        // $shipping->user_id=Auth::id();
        // $shipping->first_name=$request->first_name;
        // $shipping->last_name=$request->last_name;
        // $shipping->company_name=$request->company_name;
        // $shipping->email=$request->email;
        // $shipping->phone=$request->phone;
        // $shipping->country_id=$request->country_id;
        // $shipping->city_id=$request->city_id;
        // $shipping->zipcode=$request->zipcode;
        // $shipping->address=$request->address;
        // $shipping->total_amount=$total_amount;
        // $shipping->coupon_code=$request->coupon_code;
        // $shipping->coupon_discount=$request->coupon_discount;
        // $shipping->note=$request->note;
        // $shipping->save();

        // foreach ($carts as $ca) {
        //     $order=new Order();
        //     $order->shipping_id=$shipping->id;
        //     $order->product_id=$ca->product_id;
        //     $order->quantity=$ca->quantity;
        //     $order->product_unit_price=$ca->get_product->price;
        //     $order->save();
        // }
        // return back();
        function status(Request $request){
             /** Get the payment ID before session clear **/
        $payment_id = Session::get('paypal_payment_id');

        /** clear the session payment ID **/
        Session::forget('paypal_payment_id');
        if (empty($request->PayerId) || empty($request->token)) {

            \Session::put('error', 'Payment failed');
            return "Payment failed";
            // return Redirect::route('/');

        }

        $payment = Payment::get($payment_id, $this->_api_context);
        $execution = new PaymentExecution();
        $execution->setPayerId($request->PayerId);

        /**Execute the payment **/
        $result = $payment->execute($execution, $this->_api_context);

        if ($result->getState() == 'approved') {

            \Session::put('success', 'Payment success');
            return "Payment success";
            // return Redirect::route('/');

        }

        \Session::put('error', 'Payment failed');
        return "Payment failed2";
        // return Redirect::route('/');

            return "payment statuss";
        }
    }
}
