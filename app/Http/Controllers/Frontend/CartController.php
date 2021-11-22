<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Product;
use Gloudemans\Shoppingcart\Facades\Cart;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CartController extends Controller
{
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
        return response()->json(['success' => 'Product Added to Cart']);
    }

    /**
     * Get Mini Cart data
     */
    public function addMiniCart()
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
     * Delete mini cart Product
     */
    public function deleteMiniCart(Request $request)
    {
        # get id
        $id = $request->input('id');

        # remove from cart
        Cart::remove($id);

        # return success message
        return response()->json(['success' => 'Product Remove from Cart']);
    }
}
