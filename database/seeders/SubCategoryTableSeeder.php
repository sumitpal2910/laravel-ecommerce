<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Database\Seeder;

class SubCategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $subCatCount = (int) $this->command->ask("How many sub category for every category would you like to create?", 5);
        $categories = Category::all();

        foreach ($categories as $category) {
            SubCategory::factory($subCatCount)->make()->each(function ($subCat) use ($category) {
                $subCat->category_id = $category->id;
                $subCat->save();
            });
        }
    }
}
