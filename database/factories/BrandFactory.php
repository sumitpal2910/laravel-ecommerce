<?php

namespace Database\Factories;

use App\Models\Brand;
use Illuminate\Database\Eloquent\Factories\Factory;

class BrandFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Brand::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $name = $this->faker->company;
        $img = $this->faker->image("public/upload/brands", 300, 300, null, false);

        return [
            "name_en" => $name,
            "name_hin" => $name,
            "slug_en" => str_replace(' ', '-', strtolower($name)),
            "slug_hin" => str_replace(' ', '-', strtolower($name)),
            "image" => "upload/brands/" . $img,
        ];
    }
}
