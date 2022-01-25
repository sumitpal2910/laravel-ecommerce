<?php

namespace Database\Seeders;

use App\Models\Blog\BlogPost;
use App\Models\Blog\BlogPostCategory;
use Illuminate\Database\Seeder;

class BlogPostTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $count = (int) $this->command->ask("How many blog post would you like to create?", 20);
        $categories = BlogPostCategory::all();

        BlogPost::factory($count)->make()->each(function ($blog) use ($categories) {
            $blog->blog_post_category_id = $categories->random()->id;
            $blog->save();
        });
    }
}
