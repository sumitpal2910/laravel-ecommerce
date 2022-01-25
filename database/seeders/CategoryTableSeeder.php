<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $catCount = (int) $this->command->ask("How many category would you like to create?", 5);

        Category::factory($catCount)->create();
    }
}
