<?php

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Product::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $name = $this->faker->sentence(rand(5, 10));
        $tags = join(",", $this->faker->words(rand(1, 5)));
        $size = rand(0, 1) === 0 ? join(",", $this->faker->randomElements(['S', 'M', 'X', 'XL', 'XXL', 'XXXL'], $count = 3)) : "";
        $color = rand(0, 1) === 0 ? join(",", $this->faker->randomElements(['Red', 'Green', 'Blue', 'White', 'Black'], $count = 3)) : "";
        $shortDescp = $this->faker->paragraph();
        $descp = $this->faker->text(1000);
        $sprice = rand(0, 3000);
        $dprice = rand(0, 1000) >= $sprice ? null : rand(0, 1000);

        return [
            'name_en' => $name,
            'name_hin' => $name,
            'slug_en' => str_replace(' ', '-', strtolower($name)),
            'slug_hin' => str_replace(' ', '-', strtolower($name)),
            'qty' => rand(0, 200),
            'tags_en' => $tags,
            'tags_hin' => $tags,
            'size_en' => $size,
            'size_hin' => $size,
            'color_en' => $color,
            'color_hin' => $color,
            'selling_price' => $sprice,
            'discount_price' => $dprice,
            'short_descp_en' => $shortDescp,
            'short_descp_hin' => $shortDescp,
            'long_descp_en' => $descp,
            'long_descp_hin' => $descp,
            'hot_deals' => rand(0, 1),
            'featured' => rand(0, 1),
            'special_offer' => rand(0, 1),
            'special_deals' => rand(0, 1),
            'created_at' => $this->faker->dateTimeBetween("-3 months")
        ];
    }
}
