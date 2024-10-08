<?php

namespace Database\Factories;

use App\Models\Complaint;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Complaint>
 */
class ComplaintFactory extends Factory
{
	protected $model = Complaint::class;

	/**
	 * Define the model's default state.
	 *
	 * @return array
	 */
	public function definition()
	{
		$phoneNumberWithoutCountryCode = $this->faker->unique()->numberBetween(500000000, 599999999); // Remove country code

		$complaint = ['معامله سيئه جدا', 'معامله سيئه جدا جدا', 'معامله جيدة', 'معامله جيدة جدا'];
		return [
			'user_name' => $this->faker->name(),
			'phone'     => $phoneNumberWithoutCountryCode,
			'email'     => $this->faker->email(),
			'complaint' => $complaint[rand(0, 3)],
		];
	}
}
