<?php

namespace Database\Seeders;

use App\Models\Blog\BlogPostCategory;
use Illuminate\Database\Seeder;

class BlogPostCategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $catCount = (int) $this->command->ask("How many blog post category would you like to create?", 5);

        BlogPostCategory::factory($catCount)->create();
    }
}
