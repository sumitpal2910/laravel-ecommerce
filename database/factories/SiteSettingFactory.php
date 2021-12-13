<?php

namespace Database\Factories;

use App\Models\SiteSetting;
use Illuminate\Database\Eloquent\Factories\Factory;

class SiteSettingFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = SiteSetting::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'logo' => null,
            'phone' => null,
            'alt_phone' => null,
            'email' => null,
            'company_name' => null,
            'company_address' => null,
            'facebook' => null,
            'twitter' => null,
            'linkedin' => null,
            'youtube' => null,
        ];
    }
}
