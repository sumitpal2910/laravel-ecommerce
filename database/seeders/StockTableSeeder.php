<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\Stock;
use Illuminate\Database\Seeder;

class StockTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $products = Product::get();


            Stock::factory(rand(1, 100))->make()->each(function ($stock) use($products){
                $stock->product_id = $products->random()->id;
                $stock->save();
            });

    }
}
