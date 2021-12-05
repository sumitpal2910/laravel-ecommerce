<?php

namespace Database\Seeders;

use App\Models\Order;
use App\Models\ShipState;
use App\Models\User;
use Illuminate\Database\Seeder;

class OrderTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $count = (int) $this->command->ask("How many order do you want to create?", 20);

        $users = User::all();
        $states = ShipState::with('district')->get();

        Order::factory($count)->make()->each(function ($order) use ($users, $states) {
            $user = $users->random();
            $state = $states->random();
            $order->user_id = $user->id;
            $order->state_id = $state->id;
            $order->district_id = $state->district->random()->id;
            $order->name = $user->name;
            $order->email = $user->email;
            $order->phone = $user->phone;
            $order->save();
        });
    }
}
