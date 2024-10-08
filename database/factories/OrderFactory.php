<?php

namespace Database\Factories;

use App\Models\Order;
use Illuminate\Database\Eloquent\Factories\Factory;
use \Faker\Factory as Faker;


/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Order>
 */
class OrderFactory extends Factory
{
	protected $model = Order::class;
	/**
	 * Define the model's default state.
	 *
	 * @return array
	 */
	protected static $increment = 1;

	public function definition()
	{
		$faker = Faker::create('ar_SA');

		$data = [
			'user_id'              => self::$increment,
			'provider_id'          => self::$increment,
			'vat_per'              => $vat = settings('vat'),
			'total_products'       => $total = $faker->numberBetween(100, 1000),
			'vat_amount'           => $vat_amount = $total * $vat / 100,
			'final_total'          => $total + $vat_amount,
			'admin_commission_per' => $admin_commission = settings('administration_fee_percentage'),
			'admin_commission'     => $total * $admin_commission / 100,
			'pay_type'             => 0,
			'pay_status'           => 0,
			'pay_data'             => null,
			'lat'                  => $faker->latitude,
			'lng'                  => $faker->longitude,
			'map_desc'             => $faker->address,
			'notes'                => $faker->text(100),
		];

		self::$increment++;
		if (self::$increment > 51) {
			self::$increment = 1;
		}

		return $data;
	}
}
