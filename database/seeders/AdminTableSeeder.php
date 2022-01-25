<?php

namespace Database\Seeders;

use App\Models\Admin;
use Illuminate\Database\Seeder;

class AdminTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $adminCount = (int) $this->command->ask('How many admin would you like to create?', 1);

        Admin::factory()->customAdmin()->create();
        Admin::factory($adminCount)->create();
    }
}
