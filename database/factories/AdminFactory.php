<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Admin>
 */
class AdminFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition() 
    {
        $phoneNumber = $this->faker->unique()->e164PhoneNumber; // Generate E.164 format phone number
        $phoneNumberWithoutCountryCode = substr($phoneNumber, strpos($phoneNumber, '/') + 1); // Remove country code

        return [
            'name' => $this->faker->name,
            'email' => $this->faker->unique()->safeEmail,
			'country_code' => '966',
            'phone' => $phoneNumberWithoutCountryCode,
            'password' => 123456,
        ];
    }
}
