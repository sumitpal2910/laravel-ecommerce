<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\Admin::factory()->create();

        # refresh database
        if ($this->command->confirm('Do you want to refresh the database?', true)) {
            $this->command->call('migrate:refresh');
            $this->command->info('Database was refreshed');

            File::cleanDirectory('public/upload/products/thumbnail');
            File::cleanDirectory('public/upload/brands');
            File::cleanDirectory('public/upload/blogs');
        }

        $this->call([
            AdminTableSeeder::class,
            UserTableSeeder::class,
            BrandTableSeeder::class,
            CategoryTableSeeder::class,
            SubCategoryTableSeeder::class,
            SubSubCategoryTableSeeder::class,
            ShipStateTableSeeder::class,
            ProductTableSeeder::class,
            OrderTableSeeder::class,
            OrderItemTableSeeder::class,
            BlogPostCategoryTableSeeder::class,
            BlogPostTableSeeder::class,
            SiteSettingTableSeeder::class,
            SeoTableSeeder::class,
            ReviewTableSeeder::class,
        ]);
    }
}
