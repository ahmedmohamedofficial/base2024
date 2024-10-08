<?php

namespace Database\Factories;

use App\Models\Provider;
use Faker\Factory as Faker;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Provider>
 */
class ProviderFactory extends Factory
{
	/**
	 * The name of the factory's corresponding model.
	 *
	 * @var string
	 */
	protected $model = Provider::class;
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
		$faker = Faker::create('ar_SA');
		$phoneNumberWithoutCountryCode = $this->faker->unique()->numberBetween(500000000, 599999999); // Remove country code

		return [
            'name'        => $faker->name,
			'phone'       => $phoneNumberWithoutCountryCode,
			'country_code'=> '966',
			'email'       => $faker->unique()->email,
			'password'    => 123456,

        ];
    }
}
