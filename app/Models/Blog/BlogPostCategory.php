<?php

namespace App\Models\Blog;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BlogPostCategory extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'name_en',
        'name_hin',
        'slug_en',
        'slug_hin',
        'icon'
    ];

    /**
     * -------------------------------------------------
     *  ----    Relation    ----
     * -------------------------------------------------
     */
    /**
     * Blog posts
     */
    public function blogPost()
    {
        return $this->hasMany(BlogPost::class, 'blog_post_category_id', 'id');
    }
}
