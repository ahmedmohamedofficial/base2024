<?php

namespace Database\Seeders;

use App\Models\SiteSetting;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Cache;

class SettingSeeder extends Seeder
{
	/**
	 * Run the database seeder.
	 *
	 * This method performs the following actions:
	 * 1. Resets the settings directory.
	 * 2. Copies the default images.
	 * 3. Clears the 'settings' cache.
	 * 4. Inserts the settings data into the database.
	 */
	public function run()
	{
		// Reset the settings directory
		$this->resetSettingsDirectory();

		// Copy the default images
		$this->copyDefaultImages();

		// Clear the 'settings' cache
		Cache::forget('settings');

		// Get the settings data
		$settingsData = $this->getSettingsData();

		// Insert the settings data into the database
		SiteSetting::insert($settingsData);
	}

	/**
	 * Reset the settings directory by deleting and recreating it.
	 */
	private function resetSettingsDirectory()
	{
		// Define the path to the settings directory
		$settingsPath = storage_path('app/public/images/settings');

		// Delete the existing settings directory
		File::deleteDirectory($settingsPath);

		// Recreate the settings directory
		File::makeDirectory($settingsPath);
	}

	/**
	 * Copy the default images to the storage directory.
	 */
	private function copyDefaultImages()
	{
		// Define the list of default images to be copied
		$defaultImages = [
			'logo.png',
			'fav_icon.png',
			'login_background.png',
			'fav.png',
			'default.png',
			'intro_logo.png',
			'intro_loader.png',
			'about_image_2.png',
			'about_image_1.png',
		];

		// Loop through each default image and copy it to the storage directory
		foreach ($defaultImages as $image) {
			// Copy the image from defaults/settings to app/public/images/settings
			File::copy(
				public_path("defaults/settings/{$image}"),
				storage_path("app/public/images/settings/{$image}")
			);
		}
	}

	/**
	 * Returns an array of settings data.
	 *
	 * @return array
	 */
	private function getSettingsData() : array
	{
		return [
			['key' => 'is_production', 'value' => 0],
			['key' => 'name_ar', 'value' => 'بيز2024'],
			['key' => 'name_en', 'value' => 'base2024'],
			['key' => 'email', 'value' => 'admin@admin.com'],
			['key' => 'phone', 'value' => '+96650123456'],
			['key' => 'whatsapp', 'value' => '+96650123456'],
			['key' => 'logo', 'value' => 'logo.png'],
			['key' => 'fav_icon', 'value' => 'fav_icon.png'],
			['key' => 'login_background', 'value' => 'login_background.png'],
			['key' => 'no_data_icon', 'value' => 'fav.png'],
			['key' => 'default_user', 'value' => 'default.png'],
			['key' => 'intro_email', 'value' => 'admin@admin.com'],
			['key' => 'intro_phone', 'value' => '+96650123456'],
			['key' => 'intro_address', 'value' => 'الرياض - السعودية'],
			['key' => 'intro_logo', 'value' => 'intro_logo.png'],
			['key' => 'intro_loader', 'value' => 'intro_loader.png'],
			['key' => 'about_image_2', 'value' => 'about_image_2.png'],
			['key' => 'about_image_1', 'value' => 'about_image_1.png'],
			['key' => 'intro_name_ar', 'value' => 'بيز 2024'],
			['key' => 'intro_name_en', 'value' => 'base2024'],
			['key' => 'intro_meta_description', 'value' => 'موقع تعريفي خاص ب مشروع بيز2024 مشروع بيز2024'],
			['key' => 'intro_meta_keywords', 'value' => 'موقع تعريفي خاص ب مشروع بيز2024 مشروع  بيز2024'],
			['key' => 'intro_about_ar', 'value' => 'هذا النص هو مثال لنص يمكن أن يستبدل في نفس المساحة، لقد تم توليد هذا النص من مولد النص العربى، حيث يمكنك أن تولد مثل هذا النص أو العديد من النصوص الأخرى هذا النص هو مثال لنص يمكن أن يستبدل في نفس المساحة هذا النص هو مثال لنص يمكن أن يستبدل في نفس المساحة، لقد تم توليد هذا النص من مولد النص العربى، حيث يمكنك أن تولد مثل هذا النص أو العديد من النصوص الأخرى هذا النص هو مثال لنص يمكن أن يستبدل في نفس المساح'],
			['key' => 'intro_about_en', 'value' => 'This text is an example of text that can be replaced in the same space. This text was generated from the Arabic text generator, where you can generate such text or many other texts. This text is an example of text that can be replaced in the same space. This text is an example of text It can be replaced in the same space. This text was generated from the Arabic text generator, where you can generate such text or many other texts. This text is an example of a text that can be replaced in the same space.'],
			['key' => 'services_text_ar', 'value' => 'من خلال بناء منتج بديهي يحاكي ويسهل تنفيذ الخدمة العامة ، كان الجواب البسيط هو تزويد المستخدمين بثلاثة أشياء'],
			['key' => 'services_text_en', 'value' => 'By building an intuitive product that simulates and facilitates the implementation of public service, the simple answer has been to provide users with three things'],
			['key' => 'how_work_text_ar', 'value' => 'من خلال بناء منتج بديهي يحاكي ويسهل تنفيذ الخدمة العامة ، كان الجواب البسيط هو تزويد المستخدمين بثلاثة أشياء'],
			['key' => 'how_work_text_en', 'value' => 'By building an intuitive product that simulates and facilitates the implementation of public service, the simple answer has been to provide users with three things'],
			['key' => 'fqs_text_ar', 'value' => 'من خلال بناء منتج بديهي يحاكي ويسهل تنفيذ الخدمة العامة ، كان الجواب البسيط هو تزويد المستخدمين بثلاثة أشياء'],
			['key' => 'fqs_text_en', 'value' => 'By building an intuitive product that simulates and facilitates the implementation of public service, the simple answer has been to provide users with three things'],
			['key' => 'parteners_text_ar', 'value' => 'من خلال بناء منتج بديهي يحاكي ويسهل تنفيذ الخدمة العامة ، كان الجواب البسيط هو تزويد المستخدمين بثلاثة أشياء'],
			['key' => 'parteners_text_en', 'value' => 'By building an intuitive product that simulates and facilitates the implementation of public service, the simple answer has been to provide users with three things'],
			['key' => 'contact_text_ar', 'value' => 'من خلال بناء منتج بديهي يحاكي ويسهل تنفيذ الخدمة العامة ، كان الجواب البسيط هو تزويد المستخدمين بثلاثة أشياء'],
			['key' => 'contact_text_en', 'value' => 'By building an intuitive product that simulates and facilitates the implementation of public service, the simple answer has been to provide users with three things'],
			['key' => 'color', 'value' => '#10163a'],
			['key' => 'buttons_color', 'value' => '#7367F0'],
			['key' => 'hover_color', 'value' => '#262c49'],
			['key' => 'smtp_user_name', 'value' => 'smtp_user_name'],
			['key' => 'smtp_password', 'value' => 'smtp_password'],
			['key' => 'smtp_mail_from', 'value' => 'smtp_mail_from'],
			['key' => 'smtp_sender_name', 'value' => 'smtp_sender_name'],
			['key' => 'smtp_port', 'value' => '80'],
			['key' => 'smtp_host', 'value' => 'send.smtp.com'],
			['key' => 'smtp_encryption', 'value' => 'LTS'],
			['key' => 'firebase_key', 'value' => 'AAAAPKUauoA:APA91bEavt42dsOA-dbxnkVl16a3mKMwdOBSrqWjYBS0GGQIugm4qzDQxxtPKt2XfP7l6U_FiwUQDvdDK2G5ALZ3WGNa6XR7VBYXzvahq2VWMQRJuuhdB1HoXF87T4B5r7aAPIko_nsk'],
			['key' => 'firebase_sender_id', 'value' => '260468030080'],
			['key' => 'google_places', 'value' => 'AIzaSyBNLoYGrbnQI_GMqHt6m0PSN9yA7Zvq7gA'],
			['key' => 'google_analytics', 'value' => 'google_analytics'],
			['key' => 'max_distance', 'value' => '50'],
			['key' => 'vat', 'value' => '15'],
			['key' => 'administration_fee_percentage', 'value' => '10'],
		];
	}

}
