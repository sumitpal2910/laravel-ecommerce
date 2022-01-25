<?php

namespace Database\Factories;

use App\Models\Order;
use Illuminate\Database\Eloquent\Factories\Factory;

class OrderFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Order::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $date = $this->faker->dateTimeBetween("-6 months");
        $year = $date->format("Y");
        $month = $date->format("m");
        $date = $date->format('Y-m-d');
        $status = ['pending', 'confirmed', 'processing', 'picked', 'shipped', 'delivered', 'cancel'];

        return [
            "pincode" => rand(100000, 999999),
            "address" => $this->faker->streetAddress(),
            "city" => $this->faker->city(),
            "payment_type" => "cash",
            "payment_method" => "Cash on delivery",
            "currency" => "inr",
            "order_number" => uniqid(),
            "invoice_no" => $this->faker->randomNumber(9),
            "order_date" => $date,
            "order_year" => $year,
            "order_month" => $month,
            "amount" => $this->faker->numberBetween(100, 10000),
            "status" => $$status[rand(0, 5)],
            "created_at" => $date,
        ];
    }
}
