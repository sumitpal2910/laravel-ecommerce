<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:sanctum,admin');
    }

    /**
     * Display all category
     */
    public function viewCategory()
    {
        // fetch all data in desc order
        $categories = Category::latest()->get();

        // show all category page
        return view('backend.category.category_view', compact('categories'));
    }

    /**
     * Add new Category
     */
    public function storeCategory(Request $request)
    {
        // validate input data
        $request->validate([
            'name_en' => 'required',
            'name_hin' => 'required',
            'icon' => 'required'
        ], [
            'name_en.required' => 'Category English name is required',
            'name_hin.required' => 'Category Hindi name is required',
        ]);

        // insert data
        Category::create([
            'name_en' => $request->input('name_en'),
            'name_hin' => $request->input('name_hin'),
            'slug_en' => strtolower(str_replace(' ', '-', $request->input('name_en'))),
            'slug_hin' => str_replace(' ', '-', $request->input('name_hin')),
            'icon' => $request->input('icon')
        ]);

        // notification
        $notification = [
            'message' => 'Category add successfully',
            'alert-type' => 'success'
        ];

        // redirect back
        return redirect()->back()->with($notification);
    }

    /**
     * show edit page
     */
    public function editCategory($id)
    {
        $category = Category::findOrFail($id);
        return view('backend.category.category_edit', compact('category'));
    }

    /**
     * Update Category
     */
    public function updateCategory(Request $request)
    {
        // validate input data
        $request->validate([
            'name_en' => 'required',
            'name_hin' => 'required',
            'icon' => 'required'
        ], [
            'name_en.required' => 'Category English name is required',
            'name_hin.required' => 'Category Hindi name is required',
        ]);

        // get id
        $id = $request->input('id');

        // update data
        Category::findOrFail($id)->update([
            'name_en' => $request->input('name_en'),
            'name_hin' => $request->input('name_hin'),
            'slug_en' => strtolower(str_replace(' ', '-', $request->input('name_en'))),
            'slug_hin' => str_replace(' ', '-', $request->input('name_hin')),
            'icon' => $request->input('icon')
        ]);

        // notification
        $notification = [
            'message' => 'Category update successfully',
            'alert-type' => 'success'
        ];

        // redirect to view all category
        return redirect()->route('all.category')->with($notification);
    }

    /**
     * Delete category
     */
    public function deleteCategory($id)
    {
        // find and delete
        Category::findOrFail($id)->delete();

        // notification
        $notification = [
            'message' => 'Category delete successfully',
            'alert-type' => 'success'
        ];

        // redirect to view all category
        return redirect()->back()->with($notification);
    }
}
