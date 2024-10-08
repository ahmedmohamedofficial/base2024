<?php

namespace Database\Seeders;

use App\Models\Complaint;
use App\Models\User;
use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{

	/**
	 * Run the database seeder.
	 *
	 * This seeder will create 20 users with complaints and one user with a specific name, phone, and is_active status.
	 *
	 * @return void
	 */
	public function run()
	{

		// Create a user with a specific name, phone, and is_active status
		$this->createUserWithComplaints([
			'name'      => 'Amir Gaber',
			'phone'     => '502357765',
			'is_active' => true
		]);

		// Create 20 users with complaints
		$this->createUsersWithComplaints(50);
	}

	/**
	 * Create users with complaints.
	 *
	 * @param int $count
	 * @return void
	 */
	private function createUsersWithComplaints($count)
	{
		User::factory($count)->afterCreating(function (User $user) {
			$this->createComplaintsForUser($user);
		})->create();
	}

	/**
	 * Create a user with complaints.
	 *
	 * @param array $attributes
	 * @return void
	 */
	private function createUserWithComplaints(array $attributes)
	{
		User::factory()->afterCreating(function (User $user) {
			$this->createComplaintsForUser($user);
		})->create($attributes);
	}

	/**
	 * Create complaints for a given user.
	 *
	 * @param User $user The user for whom complaints are being created.
	 * @return void
	 */
	private function createComplaintsForUser(User $user)
	{
		// Generate 10 complaints for the user using the Complaint factory.
		// Set the complaintable_type to the class name of the user and
		// the complaintable_id to the user's id.
		Complaint::factory(2)->create([
			'complaintable_type' => get_class($user),
			'complaintable_id'   => $user->id
		]);
	}
}
