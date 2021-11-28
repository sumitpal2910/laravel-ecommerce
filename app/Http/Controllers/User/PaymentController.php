<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Mail\OrderMail;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\ShipState;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;

class PaymentController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'user']);
    }

    /**
     * Stripe payment method
     */
    public function stripe(Request $request)
    {
        # Get Total amount
        if (Session::has("coupon")) {
            $totalAmount = Session::get("coupon")['total'];
        } else {
            $totalAmount = round(Cart::total());
        }


        # get user data
        $user = $request->all();

        # get state
        $state = ShipState::findOrFail($user['state_id']);


        # stripe api key
        \Stripe\Stripe::setApiKey('sk_test_51K0Qo1SJ0G7eztoh5qKOQp5EAeFwZfWMlypzsQtfJWn6hmryRXJwqK5gkol24zoVWLbRPt4kt08SsnadHgGLPEwX009zla2mi4');

        # Get the payment token ID submitted by the form:
        $token = $_POST['stripeToken'];

        # Create Customer
        $customer = \Stripe\Customer::create(array(
            'name' => $user["name"],
            'description' => 'test description',
            'email' => $user["email"],
            'source' => $token,
            "address" => ["city" => $user['city'], "country" => "IN", "line1" => $user['address'], "postal_code" => $user['pincode'], "state" => $state->name]
        ));

        # Charge amount
        $charge = \Stripe\Charge::create([
            'customer' => $customer->id,
            'amount'   => $totalAmount * 100,
            'currency' => 'inr',
            'description' => "Laravel Ecommerce",
            'metadata' => ['order_id' => uniqid()]
        ]);


        # insert data in order table
        $order = Order::create([
            "user_id" => Auth::id(),
            "state_id" => $user['state_id'],
            "district_id" => $user['district_id'],
            'name' => $user['name'],
            'email' => $user['email'],
            'phone' => $user['phone'],
            'alt_phone' => $user['alt_phone'],
            'pincode' => $user['pincode'],
            'address' => $user['address'],
            'city' => $user['city'],
            'landmark' => $user['landmark'],
            'notes' => $user['notes'],
            'payment_type' => "stripe",
            'payment_method' => $charge->payment_method,
            'transaction_id' => $charge->balance_transaction,
            'currency' => $charge->currency,
            'amount' => $totalAmount,
            'order_number' => $charge->metadata->order_id,
            'invoice_no' => 'LE' . mt_rand(10000000, 99999999),
            'order_date' => date("Y-m-d"),
            'order_month' => date("m"),
            'order_year' => date("Y"),
            'status' => "pending"
        ]);

        # send mail to user
        $data = [
            'invoice' => $order->invoice_no,
            'amount' => $totalAmount,
            "name" => $order->name,
            'email' => $order->email
        ];

        Mail::to($user['email'])->send(new OrderMail($data));

        # get cart products
        $carts = Cart::content();

        foreach ($carts as $cart) {
            # insert data into orderItem table
            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $cart->id,
                'color' => $cart->options->color,
                'size' => $cart->options->size,
                'qty' => $cart->qty,
                'price' => $cart->price,
            ]);
        }

        # distory coupon session
        if (Session::has("coupon")) Session::forget("coupon");

        # distory cart
        Cart::destroy();

        # notification
        $notification = ['message' => 'Order Place successfully', 'alert-type' => 'success'];

        # return to dashboard
        return redirect()->route("dashboard")->with($notification);
    }

    /**
     * Cash Payment Method
     */
    public function cash(Request $request)
    {
        # Get Total amount
        if (Session::has("coupon")) {
            $totalAmount = Session::get("coupon")['total'];
        } else {
            $totalAmount = round(Cart::total());
        }


        # get user data
        $user = $request->all();

        # get state
        $state = ShipState::findOrFail($user['state_id']);

        # insert data in order table
        $order = Order::create([
            "user_id" => Auth::id(),
            "state_id" => $user['state_id'],
            "district_id" => $user['district_id'],
            'name' => $user['name'],
            'email' => $user['email'],
            'phone' => $user['phone'],
            'alt_phone' => $user['alt_phone'],
            'pincode' => $user['pincode'],
            'address' => $user['address'],
            'city' => $user['city'],
            'landmark' => $user['landmark'],
            'notes' => $user['notes'],
            'payment_type' => "cash",
            'payment_method' => "Cash On Dalivery",
            'currency' => "inr",
            'amount' => $totalAmount,
            'order_number' => uniqid(),
            'invoice_no' => 'LE' . mt_rand(10000000, 99999999),
            'order_date' => date("Y-m-d"),
            'order_month' => date("m"),
            'order_year' => date("Y"),
            'status' => "pending"
        ]);

        # send mail to user
        $data = [
            'invoice' => $order->invoice_no,
            'amount' => $totalAmount,
            "name" => $order->name,
            'email' => $order->email
        ];

        Mail::to($user['email'])->send(new OrderMail($data));

        # get cart products
        $carts = Cart::content();

        foreach ($carts as $cart) {
            # insert data into orderItem table
            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $cart->id,
                'color' => $cart->options->color,
                'size' => $cart->options->size,
                'qty' => $cart->qty,
                'price' => $cart->price,
            ]);
        }

        # distory coupon session
        if (Session::has("coupon")) Session::forget("coupon");

        # distory cart
        Cart::destroy();

        # notification
        $notification = ['message' => 'Order Place successfully', 'alert-type' => 'success'];

        # return to dashboard
        return redirect()->route("dashboard")->with($notification);
    }
}
