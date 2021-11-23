<?php

namespace Database\Seeders;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $brands = Brand::all();
        $categories = Category::with(['subCategory', 'subSubCategory'])->get();

        # ask how many product to create
        $productCount = (int) $this->command->ask('How many product would you like to create?', 20);

        # create product
        Product::factory($productCount)->make()->each(function ($product) use ($brands, $categories) {
            $category = $categories->random();
            $subCategory = $category->subCategory->random();
            $subSubCategory = $subCategory->subSubCategory->random();

            $product->brand_id = $brands->random()->id;
            $product->category_id = $category->id;
            $product->subcategory_id = $subCategory->id;
            $product->sub_subcategory_id = $subSubCategory->id;
            $product->save();
        });
    }
}
