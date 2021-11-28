<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Wishlist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WishlistController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'user'])->except(['addToWishlist']);
    }
    
    /**
     * index - show all wishlist product
     */
    public function index()
    {
        # show wishlist page
        return view('frontend.wishlist.view');
    }

    /**
     * get all wishlist product using ajax
     */
    public function getWishlistProduct()
    {
        # get user's all wishlist product
        $wishlist = Wishlist::with('product')->where('user_id', Auth::id())->latest()->get();
        # return wishlists
        return response()->json($wishlist);
    }

    /**
     * Add to wishlist
     */
    function addToWishlist(Request $request)
    {
        # check user is login or not
        if (Auth::check()) {
            # get product id
            $productId = $request->input('id');

            # get user id
            $userId = Auth::id();

            # get any exists data
            $exist = Wishlist::where([['user_id', $userId], ['product_id', $productId]])->get()->first();

            if ($exist) {
                # if the product is in wishlist, return info message
                return response()->json([
                    'status' => 'info',
                    'message' => 'Already in Wishlist'
                ]);
            }

            # insert data to database
            Wishlist::create(['user_id' => $userId, 'product_id' => $productId]);

            # return success message
            return response()->json([
                'status' => 'success',
                'message' => 'Successfully added to Wishlist'
            ]);
        } else {
            # return error message
            return response()->json([
                'status' => 'error',
                'message' => 'Login to add in Wishlist'
            ]);
        }
    }

    /**
     * Add to wishlist
     */
    public function removeWishlist(Request $request)
    {
        # get id
        $id = $request->input('id');

        # get wishlist data
        $wishlist = Wishlist::where('user_id', Auth::id())->findOrFail($id);

        # delete data
        $wishlist->delete();

        # return success message
        return response()->json([
            'status' => 'success',
            'message' => 'Product Remove from Wishlist',
            'data' => $wishlist
        ]);
    }
}
