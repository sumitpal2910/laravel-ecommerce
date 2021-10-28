<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Http\Request;

class SubCategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:sanctum,admin');
    }

    /**
     * Display all category
     */
    public function viewSubCategory()
    {
        // get all categories
        $categories = Category::orderBy('name_en', 'ASC')->get();

        // get all sub category
        $subCategories = SubCategory::latest()->with('category')->get();

        // view sub category page
        return view('backend.category.subcategory_view', compact('subCategories', 'categories'));
    }

    /**
     * Store sub category
     */
    public function storeSubCategory(Request $request)
    {
        // validate input data
        $request->validate([
            'category_id' => 'required',
            'name_en' => 'required',
            'name_hin' => 'required',
        ], [
            'category_id.required' => 'Select a Category',
            'name_en.required' => 'Sub Category English name is required',
            'name_hin.required' => 'Sub Category Hindi name is required',
        ]);

        // insert data
        SubCategory::create([
            'category_id' => $request->input('category_id'),
            'name_en' => $request->input('name_en'),
            'name_hin' => $request->input('name_hin'),
            'slug_en' => strtolower(str_replace(' ', '-', $request->input('name_en'))),
            'slug_hin' => str_replace(' ', '-', $request->input('name_hin')),
        ]);

        // notification
        $notification = [
            'message' => 'Sub Category add successfully',
            'alert-type' => 'success'
        ];

        // redirect back
        return redirect()->back()->with($notification);
    }

    /**
     * show edit page
     */
    public function editSubCategory($id)
    {
        // get all categories
        $categories = Category::orderBy('name_en', 'ASC')->get();

        // get all sub category
        $subCategory = SubCategory::findOrFail($id);

        // view sub category page
        return view('backend.category.subcategory_edit', compact('subCategory', 'categories'));
    }

    /**
     * Update Category
     */
    public function updateSubCategory(Request $request)
    {
        // validate input data
        $request->validate([
            'category_id' => 'required',
            'name_en' => 'required',
            'name_hin' => 'required',
        ], [
            'category_id.required' => 'Select a Category',
            'name_en.required' => 'Sub Category English name is required',
            'name_hin.required' => 'Sub Category Hindi name is required',
        ]);

        // get id
        $id = $request->input('id');

        // update data
        SubCategory::findOrFail($id)->update([
            'category_id' => $request->input('category_id'),
            'name_en' => $request->input('name_en'),
            'name_hin' => $request->input('name_hin'),
            'slug_en' => strtolower(str_replace(' ', '-', $request->input('name_en'))),
            'slug_hin' => str_replace(' ', '-', $request->input('name_hin')),
        ]);

        // notification
        $notification = [
            'message' => 'Sub Category update successfully',
            'alert-type' => 'success'
        ];

        // redirect to view all category
        return redirect()->route('all.subcategory')->with($notification);
    }

    /**
     * Delete category
     */
    public function deleteSubCategory($id)
    {
        // find and delete
        SubCategory::findOrFail($id)->delete();

        // notification
        $notification = [
            'message' => 'Category delete successfully',
            'alert-type' => 'success'
        ];

        // redirect to view all category
        return redirect()->back()->with($notification);
    }
}
