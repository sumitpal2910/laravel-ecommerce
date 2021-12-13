<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Show Product Details
     */
    public function productDetails($id, $slug)
    {
        # get product by id
        $product = Product::with(['multiImg', 'review' => function ($query) {
            return $query->with('user')->latest()->limit(5);
        }])->findOrFail($id);

        # get related products
        $relatedProducts = Product::where([
            ['category_id', $product->category_id],
            ['id', '!=', $id]
        ])->latest()->limit(6)->get();

        # return to product details page
        return view('frontend.product.details', compact('product', 'relatedProducts'));
    }

    /**
     * show tag wise product
     */
    public function tagWiseProduct($tag)
    {
        # get all products using tag name
        $products = Product::where([['status', 1], ['tags_en', 'like', $tag]])->orWhere('tags_hin', 'like', $tag)->latest()->paginate(6);
        // $products = Product::latest()->paginate(1);

        # show all products
        return view('frontend.tags.view', compact('products'));
    }

    /**
     * show sub category wise product
     */
    public function subCatWiseProduct($subcat, $slug)
    {
        # get products
        $products = Product::where([['status', 1], ['subcategory_id', $subcat]])->latest()->paginate(6);

        # show sub category view page
        return view('frontend.product.sub_category.view', compact('products'));
    }

    /**
     * show sub sub category wise product
     */
    public function subSubCatWiseProduct($sub_subcat, $slug)
    {
        # get products
        $products = Product::where([['status', 1], ['sub_subcategory_id', $sub_subcat]])->latest()->paginate(6);

        # show sub category view page
        return view('frontend.product.sub_sub_category.view', compact('products'));
    }

    /**
     * Show product by ajax request
     */
    public function productAjax(Request $request)
    {
        # get id
        $id = $request->input('id');
        # get product
        $product = Product::with(['category', 'brand'])->findOrFail($id);

        return response()->json($product);
    }
}
