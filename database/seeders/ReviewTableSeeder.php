<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\Review;
use App\Models\User;
use Illuminate\Database\Seeder;

class ReviewTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $count = (int) $this->command->ask("How many review would you like to write?", 100);

        $users = User::get();
        $products = Product::get();

        Review::factory($count)->make()->each(function ($review) use ($products, $users) {
            $review->user_id = $users->random()->id;
            $review->product_id = $products->random()->id;
            $review->save();
        });
    }
}
