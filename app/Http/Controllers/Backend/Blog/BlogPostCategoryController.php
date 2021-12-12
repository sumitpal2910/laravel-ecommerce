<?php

namespace App\Http\Controllers\Backend\Blog;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\Blog\BlogPostCategoryRequest;
use App\Models\Blog\BlogPostCategory;
use Illuminate\Http\Request;

class BlogPostCategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth:sanctum,admin', 'auth:admin']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        # get all category
        $categories = BlogPostCategory::orderBy('name_en', 'asc')->get();

        # show category page
        return view('backend.blog.category.index', compact('categories'));
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(BlogPostCategoryRequest $request)
    {
        # get validated data
        $data = $request->validated();

        # add sulg data
        $data['slug_en'] = strtolower(str_replace(' ', '-', $data['name_en']));
        $data['slug_hin'] = strtolower(str_replace(' ', '-', $data['name_hin']));

        # insert data
        BlogPostCategory::create($data);

        // notification
        $notification = [
            'message' => 'Blog Post Category add successfully',
            'alert-type' => 'success'
        ];

        // redirect back
        return redirect()->back()->with($notification);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        # get category
        $category = BlogPostCategory::findOrFail($id);

        # show edit page
        return view('backend.blog.category.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(BlogPostCategoryRequest $request, $id)
    {
        # get category
        $category = BlogPostCategory::findOrFail($id);

        # get validated data
        $data = $request->validated();

        # set data
        $category->name_en = $data['name_en'];
        $category->name_hin = $data['name_hin'];
        $category->slug_en = strtolower(str_replace(' ', '-', $data['name_en']));
        $category->slug_hin = strtolower(str_replace(' ', '-', $data['name_hin']));

        # update
        $category->update();

        // notification
        $notification = [
            'message' => 'Blog Post Category update successfully',
            'alert-type' => 'success'
        ];

        // redirect back
        return redirect()->route('admin.blog.cat.index')->with($notification);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        # get category
        $cat = BlogPostCategory::findOrFail($id);

        # delete
        $cat->delete();

        // notification
        $notification = [
            'message' => 'Blog post category deleted successfully',
            'alert-type' => 'success'
        ];

        // redirect back
        return redirect()->back()->with($notification);
    }
}
