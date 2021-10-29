<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\SubCategory;
use App\Models\SubSubCategory;
use Illuminate\Http\Request;

class SubCategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:sanctum,admin');
    }

    /**
     * --------------------------------------
     *  ----    SUB CATEGORY    ----
     * --------------------------------------
     */

    /**
     * Display all sub category
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
     * show sub category edit page
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
     * Update Sub Category
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
     * Delete sub category
     */
    public function deleteSubCategory($id)
    {
        // find and delete
        $data = SubCategory::findOrFail($id);
        $data->delete();

        // notification
        $notification = [
            'message' => 'Sub Category deleted successfully',
            'alert-type' => 'success'
        ];

        // redirect to view all category
        return redirect()->back()->with($notification);
    }


    /**
     * Return all sub category in JSON
     */
    public function getSubCategory($category_id)
    {
        // get all subcategoirs
        $subCategories = SubCategory::where('category_id', $category_id)->orderBy('name_en', "ASC")->get();

        // return json response
        return response()->json($subCategories);
    }


    /**
     * --------------------------------------
     *  ----    SUB SUB CATEGORY    ----
     * --------------------------------------
     */

    /**
     * Display all sub sub category
     */
    public function viewSubSubCategory()
    {
        // get all categories
        $categories = Category::orderBy('name_en', 'ASC')->get();

        // get all sub sub category with category, subCategory relation
        $subSubCategories = SubSubCategory::with('category', 'subCategory')->latest()->get();

        // view all sub sub category 
        return view('backend.category.sub_subcategory_view', compact('subSubCategories', 'categories'));
    }

    /**
     * Store sub sub category
     */
    public function storeSubSubCategory(Request $request)
    {
        // validate input data
        $request->validate([
            'category_id' => 'required',
            'subcategory_id' => 'required',
            'name_en' => 'required',
            'name_hin' => 'required',
        ], [
            'category_id.required' => 'Select a Category',
            'subcategory_id.required' => 'Select a Sub Category',
            'name_en.required' => 'Sub Sub-Category English name is required',
            'name_hin.required' => 'Sub Sub-Category Hindi name is required',
        ]);

        // insert data
        SubSubCategory::create([
            'category_id' => $request->input('category_id'),
            'subcategory_id' => $request->input('subcategory_id'),
            'name_en' => $request->input('name_en'),
            'name_hin' => $request->input('name_hin'),
            'slug_en' => strtolower(str_replace(' ', '-', $request->input('name_en'))),
            'slug_hin' => str_replace(' ', '-', $request->input('name_hin')),
        ]);

        // notification
        $notification = [
            'message' => 'Sub Sub-Category add successfully',
            'alert-type' => 'success'
        ];

        // redirect back
        return redirect()->back()->with($notification);
    }

    /**
     * show sub sub category edit page
     */
    public function editSubSubCategory($id)
    {
        // get all categories
        $categories = Category::orderBy('name_en', 'ASC')->get();

        // get sub sub category
        $subSubCategory = SubSubCategory::findOrFail($id);

        // get all sub category
        $subCategories = SubCategory::where('category_id', $subSubCategory->category_id)->orderBy('name_en', 'ASC')->get();

        // view sub category page
        return view('backend.category.sub_subcategory_edit', compact('subCategories', 'categories', 'subSubCategory'));
    }

    /**
     * Update Sub Sub Category
     */
    public function updateSubSubCategory(Request $request)
    {
        // validate input data
        $request->validate([
            'category_id' => 'required',
            'subcategory_id' => 'required',
            'name_en' => 'required',
            'name_hin' => 'required',
        ], [
            'category_id.required' => 'Select a Category',
            'subcategory_id.required' => 'Select a Sub Category',
            'name_en.required' => 'Sub Sub-Category English name is required',
            'name_hin.required' => 'Sub Sub-Category Hindi name is required',
        ]);

        // get id
        $id = $request->input('id');

        // update data
        SubSubCategory::findOrFail($id)->update([
            'category_id' => $request->input('category_id'),
            'subcategory_id' => $request->input('subcategory_id'),
            'name_en' => $request->input('name_en'),
            'name_hin' => $request->input('name_hin'),
            'slug_en' => strtolower(str_replace(' ', '-', $request->input('name_en'))),
            'slug_hin' => str_replace(' ', '-', $request->input('name_hin')),
        ]);

        // notification
        $notification = [
            'message' => 'Sub Sub Category Update successfully',
            'alert-type' => 'success'
        ];

        // redirect to view all category
        return redirect()->route('all.subSubCategory')->with($notification);
    }

    /**
     * Delete sub category
     */
    public function deleteSubSubCategory($id)
    {
        // find and delete
        $data = SubSubCategory::findOrFail($id);
        $data->delete();

        // notification
        $notification = [
            'message' => 'Sub Sub Category deleted successfully',
            'alert-type' => 'success'
        ];

        // redirect to view all category
        return redirect()->back()->with($notification);
    }
}
