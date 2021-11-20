<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\ProductRequest;
use Illuminate\Http\Request;

use App\Models\Brand;
use App\Models\Category;
use App\Models\MultiImg;
use App\Models\SubCategory;
use App\Models\SubSubCategory;
use App\Models\Product;
use Intervention\Image\Facades\Image;

class ProductController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth:sanctum,admin', 'auth:admin']);
    }

    /**
     * Show add Product page
     */
    public function addProduct()
    {
        // get all Categories
        $categories = Category::orderBy('name_en', 'asc')->get();

        // get all Brands
        $brands = Brand::orderBy('name_en', 'asc')->get();

        // show add Product page
        return view('backend.product.product_add', compact('categories', 'brands'));
    }

    /**
     * Store Product 
     */
    public function storeProduct(ProductRequest $request)
    {
        // get all validate data
        $validate = $request->validated();

        // set status
        $validate['status'] = 1;

        // set slug
        $validate['slug_en'] = strtolower(preg_replace("/[^A-Za-z0-9\-]/", '', str_replace(' ', '-', $request->input('name_en'))));
        $validate['slug_hin'] = str_replace(' ', '-', $request->input('name_hin'));

        // set product code
        $validate['code'] = "PR" . hexdec(uniqid());

        // Store Thumbnail
        if ($request->file('thumbnail')) {
            $thumb = $request->file('thumbnail');
            $name_gen = hexdec(uniqid()) . "." . $thumb->getClientOriginalExtension();
            $thumbUrl = "upload/products/thumbnail/" . $name_gen;
            Image::make($thumb)->resize(917, 1000)->save($thumbUrl);
            $validate['thumbnail'] = $thumbUrl;
        }

        // Store Product
        $product = Product::create($validate);


        // Store Multipal Images
        if ($request->file('multiImg')) {
            $images = $request->file('multiImg');
            foreach ($images as $key => $image) {
                // store image
                $name_gen = hexdec(uniqid()) . "." . $image->getClientOriginalExtension();
                $imageUrl = "upload/products/multi-img/" . $name_gen;
                Image::make($image)->resize(917, 1000)->save($imageUrl);

                // insert to database
                MultiImg::create([
                    'product_id' => $product->id,
                    'photo_name' => $imageUrl
                ]);
            }
        }

        // Notification
        $notification = [
            'message' => 'Product Add Successfully',
            'alert-type' => 'success'
        ];

        // redirect to back
        return redirect()->route("all.product")->with($notification);
    }

    /**
     * Store Product 
     */
    public function storeProductImg(Request $request)
    {
        // get product id
        $product_id = $request->input('id');

        if ($request->hasFile('multiImg')) {
            $images = $request->file('multiImg');
            foreach ($images as $key => $image) {
                // store image
                $name_gen = hexdec(uniqid()) . "." . $image->getClientOriginalExtension();
                $imageUrl = "upload/products/multi-img/" . $name_gen;
                Image::make($image)->resize(917, 1000)->save($imageUrl);

                // insert to database
                MultiImg::create([
                    'product_id' => $product_id,
                    'photo_name' => $imageUrl
                ]);
            }
        }

        // Notification
        $notification = [
            'message' => 'Product Image Added Successfully',
            'alert-type' => 'success'
        ];

        // redirect to back
        return redirect()->back()->with($notification);
    }

    /**
     * view All Products 
     */
    public function viewProduct()
    {
        // get all products
        $products = Product::latest()->get();

        // view product page
        return view('backend.product.product_view', compact('products'));
    }

    /**
     * show edit Product page 
     */
    public function editProduct($id)
    {
        // get product
        $product = Product::with('multiImg')->findOrFail($id);

        // get all brands
        $brands = Brand::orderBy('name_en', 'asc')->get();

        // get all categories
        $categories = Category::orderBy('name_en', 'asc')->get();

        // get all subcategory of product category
        $subCategories = SubCategory::where('category_id', $product->category_id)->orderBy('name_en', 'asc')->get();

        // get all sub subcategory of product category
        $subSubCategories = SubSubCategory::where('subcategory_id', $product->subcategory_id)->orderBy('name_en', 'asc')->get();

        // view edit product page
        return view('backend.product.product_edit', compact('product', 'brands', 'categories', 'subCategories', 'subSubCategories'));
    }

    /**
     * Update Product
     */
    public function updateProduct(ProductRequest $request)
    {
        // get id
        $id = $request->input('id');

        // get all validatte data
        $validate = $request->validated();

        // set slug
        $validate['slug_en'] = strtolower(preg_replace("/[^A-Za-z0-9\-]/", '', str_replace(' ', '-', $request->input('name_en'))));
        $validate['slug_hin'] = str_replace(' ', '-', $request->input('name_hin'));

        // Update Product
        Product::findOrFail($id)->update($validate);

        // Notification
        $notification = [
            'message' => 'Product Updated Successfully',
            'alert-type' => 'success'
        ];

        // redirect to back
        return redirect()->route("all.product")->with($notification);
    }

    /**
     * Update Product Image
     */
    public function updateProductImg(Request $request)
    {
        // get all images
        $images = $request->file('multiImg');

        // loop over images
        foreach ($images as $id => $img) {
            // get the image
            $oldImg = MultiImg::findOrFail($id);

            // delete the image
            if ($oldImg->photo_name) unlink($oldImg->photo_name);

            // save new image
            $nameGen = hexdec(uniqid()) . "." . $img->getClientOriginalExtension();
            $fileUrl = "upload/products/multi-img/" . $nameGen;
            Image::make($img)->resize(917, 1000)->save($fileUrl);

            // update the image
            $oldImg->update(['photo_name' => $fileUrl]);
        }

        // Notification
        $notification = [
            'message' => 'Product Image Updated Successfully',
            'alert-type' => 'success'
        ];

        // redirect to back
        return redirect()->back()->with($notification);
    }

    /**
     * Update Product Thumbnail
     */
    public function updateProductThumb(Request $request)
    {
        // get id
        $id = $request->input('id');

        // get old image
        $oldImg = $request->input('oldImg');

        // get new image
        $thumb = $request->file('thumbnail');

        // store image
        if ($thumb) {
            // unlink image
            if ($oldImg) unlink($oldImg);

            // save new image 
            $nameGen = hexdec(uniqid()) . "." . $thumb->getClientOriginalExtension();
            $fileUrl = "upload/products/thumbnail/" . $nameGen;
            Image::make($thumb)->resize(917, 1000)->save($fileUrl);

            // update in database
            Product::findOrFail($id)->update(['thumbnail' => $fileUrl]);
        }

        // Notification
        $notification = [
            'message' => 'Product Thumbnail Updated Successfully',
            'alert-type' => 'success'
        ];

        // redirect to back
        return redirect()->back()->with($notification);
    }

    /**
     * Update Product Status
     */
    public function updateProductStatus($id)
    {
        // Notification
        $notification = [
            'message' => 'Product  Active',
            'alert-type' => 'success'
        ];

        // get product
        $product = Product::findOrFail($id);

        // check and set status
        if ($product->status) {
            $product->update(['status' => 0]);
            $notification = ['message' => 'Product Inactivce', 'alert-type' => 'info'];
        } else {
            $product->update(['status' => 1]);
        }

        // redirect to back
        return redirect()->back()->with($notification);
    }

    /**
     * Delete Multipal Image
     */
    public function deleteProductImg($id)
    {
        // get image 
        $image = MultiImg::findOrFail($id);

        // unlink image
        if ($image->photo_name) unlink($image->photo_name);

        // delete data from database
        $image->delete();

        // Notification
        $notification = [
            'message' => 'Product Image Deleted Successfully',
            'alert-type' => 'success'
        ];

        // redirect to back
        return redirect()->back()->with($notification);
    }

    /**
     * Delete Product
     */
    public function deleteProduct($id)
    {
        // get product
        $product = Product::with('multiImg')->findOrFail($id);

        // unlink thumb image
        if ($product->thumbnail) unlink($product->thumbnail);

        // loop over multipal image
        foreach ($product->multiImg as $key => $img) {
            // unlink image
            if ($img->photo_name) unlink($img->photo_name);

            // delete from database
            $img->delete();
        }

        // delete product
        $product->delete();

        // Notification
        $notification = [
            'message' => 'Product Deleted Successfully',
            'alert-type' => 'info'
        ];

        // redirect to back
        return redirect()->back()->with($notification);
    }
}
