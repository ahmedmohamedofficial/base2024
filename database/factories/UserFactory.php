<?php

namespace Database\Factories;

use \Faker\Factory as Faker;
use Illuminate\Database\Eloquent\Factories\Factory;

class UserFactory extends Factory
{

	public function definition()
	{
		$phoneNumberWithoutCountryCode = $this->faker->unique()->numberBetween(500000000, 599999999); // Remove country code

		$faker = Faker::create('ar_SA');
		return [
			'name'     => $faker->name,
			'phone'    => $phoneNumberWithoutCountryCode,
			'email'    => $this->faker->unique()->email,
			'password' => 123456,
			'lat'      => $this->faker->latitude,
			'lng'      => $this->faker->longitude,
			'map_desc' => $this->faker->address,
		];
	}
}
