<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Product;
use Gloudemans\Shoppingcart\Facades\Cart;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

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

        # return success message and data
        return response()->json([
            'status' => 'success',
            'message' => 'Increment Successful',
            'data' => $cartUpdate
        ]);
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
        } else {
            # return success message and data
            return response()->json([
                'status' => 'error',
                'message' => 'Quantity is 1, can not Decrement',
                'data' => $cart
            ]);
        }


        # return success message and data
        return response()->json([
            'status' => 'success',
            'message' => 'Decrement Successful',
            'data' => $cartUpdate
        ]);
    }
}
