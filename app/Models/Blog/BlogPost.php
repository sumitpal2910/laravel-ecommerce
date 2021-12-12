<?php

namespace App\Models\Blog;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BlogPost extends Model
{
    use HasFactory;

    protected $fillable = [
        'blog_post_category_id',
        'title_en',
        'title_hin',
        'slug_en',
        'slug_hin',
        'image',
        'content_en',
        'content_hin',
    ];

    /**
     * -------------------------------------------------
     *  ----    Relation    ----
     * -------------------------------------------------
     */

    /**
     * Category
     */
    public function category()
    {
        return $this->belongsTo(BlogPostCategory::class, 'blog_post_category_id', 'id');
    }
}
