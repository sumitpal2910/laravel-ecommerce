<?php

namespace Database\Factories\Blog;

use App\Models\Blog\BlogPost;
use Illuminate\Database\Eloquent\Factories\Factory;

class BlogPostFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = BlogPost::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $name = $this->faker->sentence(rand(3, 6));
        $img = $this->faker->image('public/upload/blogs', 780, 433, null, false);
        $content = $this->faker->text(1000);
        return [
            'title_en' => $name,
            'title_hin' => $name,
            'slug_en' => strtolower(str_replace(' ', '-', $name)),
            'slug_hin' => strtolower(str_replace(' ', '-', $name)),
            'image' => "upload/blogs/$img",
            'content_en' => $content,
            'content_hin' => $content,
            "created_at" => $this->faker->dateTimeBetween("-3 months"),
        ];
    }
}
