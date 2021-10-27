<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class BrandController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:sanctum,admin');
    }
    /**
     * view all brand
     */
    public function viewBrand()
    {
        $brands = Brand::latest()->get();
        return view('backend.brand.brand_view', compact('brands'));
    }

    /**
     * store new brand
     */
    public function storeBrand(Request $request)
    {
        // Validate data
        $request->validate([
            'name_en' => 'required',
            'name_hin' => 'required',
            'image' => 'required',
        ], [
            'name_en.required' => 'Brand name english is required',
            'name_hin.required' => 'Brand name hindi is required',
        ]);

        // resize and store image
        $image = $request->file('image');
        $nameGen = hexdec(uniqid()) . "." . $image->getClientOriginalExtension();
        $fileUrl = 'upload/brands/' . $nameGen;
        Image::make($image)->resize(300, 300)->save($fileUrl);

        // insert data
        Brand::insert([
            'name_en' => $request->input('name_en'),
            'name_hin' => $request->input('name_hin'),
            'slug_en' => strtolower(str_replace(' ', '-', $request->name_en)),
            'slug_hin' => str_replace(' ', '-', $request->name_hin),
            'image' => $fileUrl
        ]);

        // Notification
        $notification = [
            'message' => 'Brand add successfully',
            'alert-type' => 'success'
        ];

        // Redirect
        return redirect()->back()->with($notification);
    }

    /**
     * edit brand
     */
    public function editBrand($id)
    {
        $brand = Brand::findOrFail($id);
        return view('backend.brand.brand_edit', compact('brand'));
    }

    /**
     * Update brand
     */
    public function updateBrand(Request $request)
    {
        // Validate data
        $request->validate([
            'name_en' => 'required',
            'name_hin' => 'required',
        ], [
            'name_en.required' => 'Brand name english is required',
            'name_hin.required' => 'Brand name hindi is required',
        ]);

        // get id and old image
        $id = $request->id;
        $oldImage = $request->oldImage;


        if ($request->file('image')) {
            // unlink old image
            if ($oldImage) {
                unlink($oldImage);
            }

            // store new image
            $image = $request->file('image');
            $nameGen = hexdec(uniqid()) . "." . $image->getClientOriginalExtension();
            $fileUrl = "upload/brands/" . $nameGen;
            Image::make($image)->resize(300, 300)->save($fileUrl);

            // Update data
            Brand::findOrFail($id)->update([
                'name_en' => $request->name_en,
                'name_hin' => $request->name_hin,
                'slug_en' => strtolower(str_replace(' ', '-', $request->name_en)),
                'slug_hin' => str_replace(' ', '-', $request->name_en),
                'image' => $fileUrl
            ]);
        } else {
            // Update data
            Brand::findOrFail($id)->update([
                'name_en' => $request->name_en,
                'name_hin' => $request->name_hin,
                'slug_en' => strtolower(str_replace(' ', '-', $request->name_en)),
                'slug_hin' => str_replace(' ', '-', $request->name_en)
            ]);
        }

        // notification
        $notification = [
            'message' => 'Brand update successfully',
            'alert-type' => 'success'
        ];

        // return to all brands page
        return redirect()->route('all.brand')->with($notification);
    }


    /**
     * Delete brand
     */
    public function deleteBrand($id)
    {
        // get brand
        $brand = Brand::findOrFail($id);
        $image = $brand->image;

        // unlink image
        if ($image) {
            unlink($image);
        }

        // delete data
        Brand::findOrFail($id)->delete();

        // notification
        $notification = [
            'message' => 'Brand deleted successfully',
            'alert-type' => 'success'
        ];

        // redirect
        return redirect()->back()->with($notification);
    }
}
