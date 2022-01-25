<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\SubSubCategory;
use Illuminate\Database\Seeder;

class SubSubCategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $count = (int) $this->command->ask("How many sub sub category for every sub category would you like to create?", 5);
        $categories = Category::with('subCategory')->get();

        foreach ($categories as $cat) {
            foreach ($cat->subCategory as $subCat) {
                SubSubCategory::factory(5)->make()->each(function ($subSub) use ($cat, $subCat) {
                    $subSub->category_id = $cat->id;
                    $subSub->subcategory_id = $subCat->id;
                    $subSub->save();
                });
            }
        }
    }
}
