<?php

namespace Database\Factories;

use App\Models\Review;
use Illuminate\Database\Eloquent\Factories\Factory;

class ReviewFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Review::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'comment' => $this->faker->text(rand(20, 300)),
            'summary' => $this->faker->sentence(rand(3, 6)),
            'status' => rand(0, 1),
            'created_at' => $this->faker->dateTimeBetween("-3 months"),
        ];
    }
}
