<?php
namespace Database\Seeders;
use App\Models\Admin;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;

class AdminTableSeeder extends Seeder
{
	public function run()
	{
		File::deleteDirectory(storage_path('app/public/images/' . Admin::IMAGEPATH));
		File::makeDirectory(storage_path('app/public/images/' . Admin::IMAGEPATH));

		Admin::factory()->create([
			'name'     => 'Manager',
			'email'    => 'admin@admin.com',
			'phone'    => '555105813',
			'password' => 123456,
			'type'     => 'super_admin',
			'country_code' => '966',
		]);
		Admin::factory(10)->create();
	}
}
