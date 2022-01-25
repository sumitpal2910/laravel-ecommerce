<?php

namespace Database\Factories\Blog;

use App\Models\Blog\BlogPostCategory;
use Illuminate\Database\Eloquent\Factories\Factory;

class BlogPostCategoryFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = BlogPostCategory::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $name = $this->faker->sentence(rand(1, 2));
        return [
            "name_en" => $name,
            "name_hin" => $name,
            "slug_en" => str_replace(' ', '-', strtolower($name)),
            "slug_hin" => str_replace(' ', '-', strtolower($name)),
        ];
    }
}
