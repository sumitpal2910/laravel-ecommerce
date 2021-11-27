<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Product;
use Gloudemans\Shoppingcart\Facades\Cart;

use App\Http\Controllers\Controller;
use App\Models\Coupon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class CartController extends Controller
{
    public function __construct()
    {
        // 
    }

    /**
     * show my cart page
     */
    public function index()
    {
        return view('frontend.cart.view');
    }


    /**
     * --------------------------------------
     *  Ajax Request
     * --------------------------------------
     */

    /**
     * Product Add to Cart
     */
    public function addToCart(Request $request)
    {
        # get id
        $id = $request->input('id');

        # get product
        $product = Product::findOrFail($id);

        # price
        $price = $product->discount_price ?? $product->selling_price;

        # save to Cart
        Cart::add([
            'id' => $id,
            'name' => $request->input('name'),
            'qty' => $request->input('qty'),
            'price' => $price, 'weight' => 1,
            'options' => [
                'code' => $request->input('code'),
                'image' => $product->thumbnail,
                'size' => $request->input('size'),
                'color' => $request->input('color')
            ]
        ]);

        # return message
        return response()->json([
            'status' => 'success',
            'message' => 'Product Added to Cart'
        ]);
    }

    /**
     * Get Cart data
     */
    public function getCartProduct()
    {
        # get cart all data
        $carts = Cart::content();

        # get cart quantity
        $cartQty = Cart::count();

        # get cart total price
        $cartTotal = Cart::total();

        # return all data
        return response()->json([
            'carts' => $carts,
            'cartQty' => $cartQty,
            'cartTotal' => round($cartTotal)
        ]);
    }

    /**
     * Delete Cart Product
     */
    public function deleteCart(Request $request)
    {
        # get id
        $id = $request->input('id');

        # remove from cart
        Cart::remove($id);

        # forget coupon
        if (Cart::total() == 0) {
            Session::forget('coupon');
        }

        # return success message
        return response()->json([
            'status' => 'success',
            'message' => 'Product Remove from Cart'
        ]);
    }

    /**
     * Increment Quantity 
     */
    public function increment(Request $request)
    {
        # get id
        $id = $request->input('id');

        # get cart
        $cart = Cart::get($id);

        # update cart
        $cartUpdate = Cart::update($id, $cart->qty + 1);

        if (Session::has('coupon')) {
            # get coupon
            $couponName = Session::get('coupon')['coupon_name'];
            $coupon = Coupon::where('name', $couponName)->get()->first();

            # discount amount 
            $discount = round((Cart::total() * $coupon->discount) / 100);
            # total amount
            $total = Cart::total() - $discount;

            # update coupon in session
            Session::put('coupon', [
                "coupon_name" => $coupon->name,
                "discount" => $coupon->discount,
                "discount_amount" => $discount,
                "total" => $total
            ]);
        }

        # return success message and data
        return response()->json(['status' => 'success', 'message' => 'Increment Successful', 'data' => $cartUpdate]);
    }

    /**
     * Decrement Quantity 
     */
    public function decrement(Request $request)
    {
        # get id
        $id = $request->input('id');

        # get cart
        $cart = Cart::get($id);

        if ($cart->qty > 1) {
            # update cart
            $cartUpdate = Cart::update($id, $cart->qty - 1);

            if (Session::has('coupon')) {
                # get coupon
                $couponName = Session::get('coupon')['coupon_name'];
                $coupon = Coupon::where('name', $couponName)->get()->first();

                # discount amount 
                $discount = round((Cart::total() * $coupon->discount) / 100);
                # total amount
                $total = Cart::total() - $discount;

                # update coupon in session
                Session::put('coupon', [
                    "coupon_name" => $coupon->name,
                    "discount" => $coupon->discount,
                    "discount_amount" => $discount,
                    "total" => $total
                ]);
            }
        } else {
            # return success message and data
            return response()->json(['status' => 'error', 'message' => 'Quantity is 1, can not Decrement', 'data' => $cart]);
        }

        # return success message and data
        return response()->json(['status' => 'success',  'message' => 'Decrement Successful', 'data' => $cartUpdate]);
    }

    /**
     * Apply Coupon
     */
    public function couponApply(Request $request)
    {
        # get coupon name
        $couponName = $request->input('coupon');

        # get coupon from database
        $coupon = Coupon::where([['name', $couponName], ['status', 1]])->get()->first();

        if ($coupon) {
            if ($coupon->validity >= now()) {
                # discount amount 
                $discount = round((Cart::total() * $coupon->discount) / 100);
                # total amount
                $total = Cart::total() - $discount;

                # set coupon in session
                Session::put('coupon', [
                    "coupon_name" => $coupon->name,
                    "discount" => $coupon->discount,
                    "discount_amount" => $discount,
                    "total" => $total
                ]);

                # return success message
                return response()->json(['status' => 'success', 'message' => 'Coupon Applied Successfully', 'data' => $coupon]);
            } else {
                # return error message
                return response()->json(['status' => 'error', 'message' => 'Coupon Expeired', 'data' => $coupon]);
            }
        } else {
            # return with error message
            return response()->json(['status' => 'error', 'message' => 'In Valid Coupon', 'data' => $coupon]);
        }
    }

    /**
     * Coupon Calculation 
     */
    public function couponCalculation()
    {
        # set data
        $data = ["total" => Cart::total()];

        if (Session::has('coupon')) {
            # set session data
            $data = Session::get('coupon');
            $data["subTotal"] = (int) Cart::total();
        }

        # return json data
        return response()->json($data);
    }

    /**
     * Coupon Remove
     */
    public function couponRemove()
    {
        # forget session
        Session::forget('coupon');

        # return success message
        return response()->json(['status' => 'success', 'message' => 'Coupon Remove Successfully']);
    }

    /**
     * Cart Update - this function will update price after apply discount in session
     */
    public function couponUpdate()
    {
        if (Session::has('coupon')) {
            # get coupon name
            $couponName = Session::get('coupon')['coupon_name'];

            # get coupon from database
            $coupon = Coupon::where([['name', $couponName], ['status', 1]])->get()->first();

            # discount amount 
            $discount = round((Cart::total() * $coupon->discount) / 100);
            # total amount
            $total = Cart::total() - $discount;

            # set coupon in session
            Session::put('coupon', [
                "coupon_name" => $coupon->name,
                "discount" => $coupon->discount,
                "discount_amount" => $discount,
                "total" => $total
            ]);
        }

        return Session::get('coupon');
    }
}
