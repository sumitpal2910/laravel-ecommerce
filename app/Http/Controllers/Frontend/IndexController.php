<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use App\Models\Slider;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class IndexController extends Controller
{
    /**
     * Display index page
     */
    public function index()
    {
        # get all category, sub category, sub sub category and products
        $categories = Category::with(['subCategory', 'subCategory.subSubCategory', 'products' => function ($query) {
            return $query->limit(6)->latest();
        }])->orderBy('name_en', 'asc')->get();

        # get slider
        $sliders = Slider::where('status', 1)->orderBy('id', 'desc')->limit(3)->get();

        # get products
        $products = Product::where('status', 1)->orderBy('id', 'desc')->limit(6)->get();

        # get featured products
        $featured = Product::where('status', 1)->where('featured', 1)->orderBy('id', 'desc')->limit(6)->get();

        # get hot deals
        $hotDeals = Product::where([
            ['status', 1],
            ['hot_deals', 1],
            ['discount_price', '>', 0]
        ])->orderBy('id', 'desc')->limit(3)->get();

        # get special offer
        $specialOffer = Product::where('status', 1)->where('special_offer', 1)->orderBy('id', 'desc')->limit(6)->get();

        # get special deals
        $specialDeals = Product::where('status', 1)->where('special_deals', 1)->orderBy('id', 'desc')->limit(6)->get();

        # get skip category with product
        $skipCategory0 = Category::with(['products' => function ($query) {
            return $query->latest();
        }])->skip(0)->first();

        # get skip category with product
        $skipCategory1 = Category::with(['products' => function ($query) {
            return $query->latest();
        }])->skip(1)->first();

        # get brand with products
        $skipBrand0 = Brand::with('products')->skip(1)->first();

        # show index page
        return view('frontend.index', compact(
            'categories',
            'sliders',
            'products',
            'featured',
            'hotDeals',
            'specialOffer',
            'specialDeals',
            'skipCategory0',
            'skipCategory1',
            'skipBrand0'
        ));
    }

    /**
     * User logout
     */
    public function userLogout()
    {
        Auth::logout();
        return redirect()->route('login');
    }

    /**
     * Show user profile
     */
    public function userProfile()
    {
        $id = Auth::id();
        $user = User::findOrFail($id);
        return view('frontend.profile.user_profile', compact('user'));
    }



    /**
     * Update user profile
     */
    public function userProfileStore(Request $request)
    {
        # Find the data from database
        $user = User::findOrFail(Auth::id());

        # Change email and name
        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone = $request->phone;

        if ($request->file('profile_photo_path')) {
            # Remove Old Image
            if ($user->profile_photo_path) {
                unlink("upload/user_images/" . $user->profile_photo_path);
            }

            # Store New Image
            $file = $request->file('profile_photo_path');
            $fileName = date('YmdHi') . $file->getClientOriginalName();
            $file->move(public_path('upload/user_images/'), $fileName);
            $user->profile_photo_path = $fileName;
        }
        # Save changes
        $user->save();

        # Toastr notification
        $notification = ['message' => 'Profile has been updated', 'alert-type' => 'success'];

        # return to user profile page with message
        return redirect()->route('dashboard')->with($notification);
    }

    /**
     * Change user password
     */
    public function userChangePassword()
    {
        # get user
        $user = Auth::user();

        # return to change password page
        return view('frontend.profile.change_password', compact('user'));
    }

    /**
     * Update user password
     */
    public function userPasswordUpdate(Request $request)
    {
        # validate
        $request->validate([
            'oldpassword' => 'required',
            'password' => 'required|confirmed'
        ]);

        # get hashed password
        $hashedPassword = Auth::user()->password;

        # check hash and password match
        if (Hash::check($request->oldpassword, $hashedPassword)) {
            $user = User::find(Auth::id());
            $user->password = Hash::make($request->password);
            $user->save();
            Auth::logout();
            return redirect()->route('user.logout');
        } else {
            return redirect()->back();
        }
    }

    /**
     * Show Product Details
     */
    public function productDetails($id, $slug)
    {
        # get product by id
        $product = Product::with('multiImg')->findOrFail($id);

        # get hot deals
        $hotDeals = Product::where('status', 1)->where('hot_deals', 1)->orderBy('id', 'desc')->limit(3)->get();

        # return to product details page
        return view('frontend.product.details', compact('product', 'hotDeals'));
    }
}
