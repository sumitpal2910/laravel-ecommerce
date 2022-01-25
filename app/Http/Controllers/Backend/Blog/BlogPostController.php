<?php

namespace App\Http\Controllers\Backend\Blog;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\Blog\BlogPostRequest;
use App\Models\Blog\BlogPost;
use App\Models\Blog\BlogPostCategory;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class BlogPostController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth:sanctum,admin', 'auth:admin']);
    }

    /**
     * Display a listing of the resource.
     *
     */
    public function index()
    {
        # get all blog posts
        $blogPosts = BlogPost::with('category')->latest()->get();

        # show blog posts
        return view('backend.blog.post.index', compact('blogPosts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     */
    public function create()
    {
        # get all category
        $categories = BlogPostCategory::orderBy('name_en', 'asc')->get();

        # show create page
        return view('backend.blog.post.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     */
    public function store(BlogPostRequest $request)
    {
        # get validated data
        $validate = $request->validated();

        # add slug
        $validate['slug_en'] = strtolower(preg_replace("/[^A-Za-z0-9\-]/", '', str_replace(' ', '-', $request->input('title_en'))));
        $validate['slug_hin'] = str_replace(' ', '-', $request->input('title_hin'));

        # save image
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $name_gen = hexdec(uniqid()) . "." . $image->getClientOriginalExtension();
            $imageUrl = "upload/blogs/" . $name_gen;
            Image::make($image)->resize(780, 433)->save($imageUrl);
            $validate['image'] = $imageUrl;
        }

        # store data
        BlogPost::create($validate);

        #  Notification
        $notification = [
            'message' => 'Blog Post Created Successfully',
            'alert-type' => 'success'
        ];

        # redirect to all blog page
        return redirect()->route("admin.blog.index")->with($notification);
    }


    /**
     * Show the form for editing the specified resource.
     *
     */
    public function edit($id)
    {
        # get blog
        $blogPost = BlogPost::findOrFail($id);

        # get all category
        $categories = BlogPostCategory::orderBy('name_en', 'asc')->get();

        # show edit page
        return view('backend.blog.post.edit', compact('blogPost', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     */
    public function update(BlogPostRequest $request, $id)
    {
        # get blog post
        $blogPost = BlogPost::findOrFail($id);

        # get validated data
        $validate = $request->validated();

        # add slug
        $validate['slug_en'] = strtolower(preg_replace("/[^A-Za-z0-9\-]/", '', str_replace(' ', '-', $request->input('title_en'))));
        $validate['slug_hin'] = str_replace(' ', '-', $request->input('title_hin'));

        if ($request->hasFile('image')) {
            # unlink image
            if ($blogPost->image) unlink(public_path($blogPost->image));

            # create new image
            $image = $request->file('image');
            $name_gen = hexdec(uniqid()) . "." . $image->getClientOriginalExtension();
            $imageUrl = "upload/blogs/" . $name_gen;
            Image::make($image)->resize(780, 433)->save($imageUrl);
            $validate['image'] = $imageUrl;
        }

        # update data
        $blogPost->update($validate);

        #  Notification
        $notification = [
            'message' => 'Blog Post Updated Successfully',
            'alert-type' => 'success'
        ];

        # redirect to all blog page
        return redirect()->route("admin.blog.index")->with($notification);
    }

    /**
     * Remove the specified resource from storage.
     *
     */
    public function delete($id)
    {
        # get blog post
        $blogPost = BlogPost::findOrFail($id);

        # unlink image
        if ($blogPost->image) unlink(public_path($blogPost->image));

        # delete data
        $blogPost->delete();

        #  Notification
        $notification = [
            'message' => 'Blog Post Deleted Successfully',
            'alert-type' => 'success'
        ];

        # redirect to all blog page
        return redirect()->back()->with($notification);
    }
}
