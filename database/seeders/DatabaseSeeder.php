<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

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
        ]);
    }
}
