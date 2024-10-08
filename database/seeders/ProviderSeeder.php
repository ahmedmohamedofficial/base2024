<?php

namespace Database\Seeders;

use App\Enums\ProviderApproved;
use App\Models\Complaint;
use App\Models\Provider;
use Illuminate\Database\Seeder;

class ProviderSeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		// Create a provider with a specific name, phone, and is_active status
		$this->createProviderWithComplaints([
			'name'      => 'Amir Gaber',
			'phone'     => '502357765',
			'is_active' => true,
			'is_approved' => ProviderApproved::ACCEPTED
		]);

		// Create 20 providers with complaints
		$this->createProvidersWithComplaints(50);
	}

	/**
	 * Create providers with complaints.
	 *
	 * @param int $count
	 * @return void
	 */
	private function createProvidersWithComplaints($count)
	{
		Provider::factory($count)->afterCreating(function (Provider $provider) {
			$this->createComplaintsForProvider($provider);
		})->create();
	}

	/**
	 * Create a provider with complaints.
	 *
	 * @param array $attributes
	 * @return void
	 */
	private function createProviderWithComplaints(array $attributes)
	{
		Provider::factory()->afterCreating(function (Provider $provider) {
			$this->createComplaintsForProvider($provider);
		})->create($attributes);
	}

	/**
	 * Create complaints for a given provider.
	 *
	 * @param Provider $provider The provider for whom complaints are being created.
	 * @return void
	 */
	private function createComplaintsForProvider(Provider $provider)
	{
		// Generate 10 complaints for the provider using the Complaint factory.
		// Set the complaintable_type to the class name of the provider and
		// the complaintable_id to the provider's id.
		Complaint::factory(2)->create([
			'complaintable_type' => get_class($provider),
			'complaintable_id'   => $provider->id
		]);
	}
}
