<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Blog\BlogPost;
use App\Models\Blog\BlogPostCategory;
use Illuminate\Http\Request;

class BlogPostController extends Controller
{
    public function __construct()
    {
        //
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        # get all blogs
        $blogPosts = BlogPost::latest()->paginate(10);

        # show blog page
        return view('frontend.blog.index', compact('blogPosts'));
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id, $slug)
    {
        # get blog post
        $blogPost = BlogPost::findOrFail($id);

        # show blog
        return view('frontend.blog.show', compact('blogPost'));
    }

    /**
     * show blog post by category
     */
    public function category($id, $slug)
    {
        # get all blog
        $blogPosts = BlogPost::where('blog_post_category_id', $id)->latest()->paginate(10);

        # show blog page
        return view('frontend.blog.index', compact('blogPosts'));
    }
}
