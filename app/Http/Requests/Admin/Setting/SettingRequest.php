<?php

namespace App\Http\Requests\Admin\Setting;

use App\Http\Requests\BaseRequest;

class SettingRequest extends BaseRequest
{
	/**
	 * Determine if the user is authorized to make this request.
	 *
	 * @return bool
	 */
	public function authorize()
	{
		return true;
	}

	/**
	 * Get the validation rules that apply to the request.
	 *
	 * @return array The validation rules for the request.
	 */
	public function rules(): array
	{
		// Use a match expression to determine the validation rules based on the type_setting value.
		return match ($this->type_setting) {
			'intro_app_setting'    => $this->introAppSettingRules(),    // Validation rules for intro_app_setting.
			'intro_about_app'      => $this->introAboutAppRules(),      // Validation rules for intro_about_app.
			'intro_texts'          => $this->introTextsRules(),         // Validation rules for intro_texts.
			'app_setting'          => $this->appSettingRules(),         // Validation rules for app_setting.
			'smtp'                 => $this->smtpRules(),               // Validation rules for smtp.
			'notification'         => $this->notificationRules(),       // Validation rules for notification.
			'api'                  => $this->apiRules(),                // Validation rules for api.
			default                => [],                               // Default validation rules.
		};
	}

	/**
	 * Define the validation rules for intro app settings.
	 *
	 * @return array The validation rules for intro app settings.
	 */
	private function introAppSettingRules(): array
	{
		return [
			'intro_name_ar' => 'required|max:255',
			'intro_name_en' => 'required|max:255',
			'intro_email'   => 'required|email:filter|max:255',
			'intro_phone'   => 'required|string|regex:/^\+?[0-9]{9,12}$/',
			'intro_address' => 'required|max:255',
			'color'         => 'required|max:255',
			'buttons_color' => 'required|max:255',
			'hover_color'   => 'required|max:255',
			'intro_loader'  => 'nullable|mimes:' . $this->mimesImage(),
			'intro_logo'    => 'nullable|mimes:' . $this->mimesImage(),
		];
	}

	/**
	 * Define the validation rules for intro about app.
	 *
	 * @return array The validation rules for intro about app.
	 */
	private function introAboutAppRules(): array
	{
		return [
			'intro_about_ar' => 'required', // Arabic intro about field is required.
			'intro_about_en' => 'required', // English intro about field is required.
			'about_image_1'  => 'nullable|mimes:' . $this->mimesImage(), // About image 1 must be nullable and follow mimes restriction.
			'about_image_2'  => 'nullable|mimes:' . $this->mimesImage(), // About image 2 must be nullable and follow mimes restriction.
		];
	}

	/**
	 * Define the validation rules for intro texts.
	 *
	 * @return array The validation rules for intro texts.
	 */
	private function introTextsRules(): array
	{
		// Define the validation rules for each intro text field.
		// The 'required' rule ensures that the field is not empty.
		return [
			'services_text_ar'  => 'required', // Arabic services text field is required.
			'services_text_en'  => 'required', // English services text field is required.
			'how_work_text_ar'  => 'required', // Arabic how work text field is required.
			'how_work_text_en'  => 'required', // English how work text field is required.
			'fqs_text_ar'       => 'required', // Arabic FQS text field is required.
			'fqs_text_en'       => 'required', // English FQS text field is required.
			'parteners_text_ar' => 'required', // Arabic partners text field is required.
			'parteners_text_en' => 'required', // English partners text field is required.
			'contact_text_ar'   => 'required', // Arabic contact text field is required.
			'contact_text_en'   => 'required', // English contact text field is required.
		];
	}

	/**
	 * Define the validation rules for the app settings.
	 *
	 * @return array The validation rules for the app settings.
	 */
	private function appSettingRules(): array
	{
		return [
			'name_ar'                       => 'required|max:255',// The name in Arabic is required and cannot exceed 255 characters.
			'name_en'                       => 'required|max:255',// The name in English is required and cannot exceed 255 characters.
			'email'                         => 'required|email:filter|max:255',// The email is required, must be a valid email address, and cannot exceed 255 characters.
			'phone'                         => 'required|string|regex:/^\+?[0-9]{9,12}$/',// The phone number is required and must be between 10 and 20 digits.
			'whatsapp'                      => 'required|string|regex:/^\+?[0-9]{9,12}$/',// The WhatsApp number is required and must be between 10 and 20 digits.
			'logo'                          => 'nullable|mimes:' . $this->mimesImage(),// The logo file is optional and must be an image file.
			'fav_icon'                      => 'nullable|mimes:' . $this->mimesImage(),// The favicon file is optional and must be an image file.
			'login_background'              => 'nullable|mimes:' . $this->mimesImage(),// The login background file is optional and must be an image file.
			'default_user'                  => 'nullable|mimes:' . $this->mimesImage(),// The default user file is optional and must be an image file.
			'is_production'                 => 'nullable', // The is production field is optional.
			'max_distance'                  => 'required', // The maximum distance field is required.
			'vat'                           => 'required|numeric|max:100', // The VAT field is required, numeric, and cannot exceed 100.
			'administration_fee_percentage' => 'required|numeric|max:100', // The administration fee percentage field is required, numeric, and cannot exceed 100.
		];
	}

	/**
	 * Returns the validation rules for the SMTP settings.
	 *
	 * @return array The validation rules.
	 */
	private function smtpRules(): array
	{
		// Define the validation rules for the SMTP settings.
		// All fields are required.
		return [
			'smtp_user_name'   => 'required', // The SMTP user name is required.
			'smtp_password'    => 'required', // The SMTP password is required.
			'smtp_mail_from'   => 'required', // The SMTP mail from is required.
			'smtp_sender_name' => 'required', // The SMTP sender name is required.
			'smtp_host'        => 'required', // The SMTP host is required.
			'smtp_encryption'  => 'required', // The SMTP encryption is required.
			'smtp_port'        => 'required', // The SMTP port is required.
		];
	}

	/**
	 * Returns the validation rules for the notification settings.
	 *
	 * @return array The validation rules for the notification settings.
	 */
	private function notificationRules(): array
	{
		// Define the validation rules for the notification settings.
		return [
			'firebase_key'       => 'required', // The Firebase key is required.
			'firebase_sender_id' => 'required', // The Firebase sender ID is required.
		];
	}

	/**
	 * Returns the validation rules for the API settings.
	 *
	 * @return array The validation rules for the API settings.
	 */
	private function apiRules(): array
	{
		// Define the validation rules for the API settings.
		return [
			'google_analytics' => 'required', // The Google Analytics field is required.
			'google_places'    => 'required', // The Google Places field is required.
		];
	}

	/**
	 * Get the attributes for the setting request.
	 *
	 * @return array The attributes for the setting request.
	 */
	public function attributes(): array
	{
		// Define the attributes for the setting request.
		return [
			'intro_name_ar'                 => __('admin.name_of_induction_in_arabic'),
			'intro_name_en'                 => __('admin.name_of_the_induction_of_english'),
			'intro_email'                   => __('admin.email'),
			'intro_phone'                   => __('admin.phone'),
			'intro_address'                 => __('admin.address'),
			'color'                         => __('admin.The_main_website_color'),
			'buttons_color'                 => __('admin.the_color_of_the_buttons'),
			'hover_color'                   => __('admin.color_of_hover'),
			'intro_loader'                  => __('admin.Picture_of_Loader'),
			'intro_logo'                    => __('admin.logo_image_induction'),
			'intro_about_ar'                => __('admin.about_the_arabic_application'),
			'intro_about_en'                => __('admin.about_the_english_application'),
			'about_image_1'                 => __('admin.image_of_the_first_application'),
			'about_image_2'                 => __('admin.Picture_of_the_second_application'),
			'services_text_ar'              => __('admin.address_of_our_services_section_in_arabic'),
			'services_text_en'              => __('admin.the_title_of_our_english_service_department'),
			'how_work_text_ar'              => __('admin.the_title_of_how_the_site_works_in_arabic'),
			'how_work_text_en'              => __('admin.the_title_of_the_section_of_how_the_english_site_works'),
			'fqs_text_ar'                   => __('admin.the_address_of_the_questions_section_in_arabic'),
			'fqs_text_en'                   => __('admin.the_address_of_the_questions_section_english'),
			'parteners_text_ar'             => __('admin.the_title_of_our_partition_in_arabic'),
			'parteners_text_en'             => __('admin.the_title_of_our_english_partition'),
			'contact_text_ar'               => __('admin.address_in_arabic_communication'),
			'contact_text_en'               => __('admin.address_in_english_communication'),
			'name_ar'                       => __('admin.the_name_of_the_application_in_arabic'),
			'name_en'                       => __('admin.the_name_of_the_application_in_english'),
			'email'                         => __('admin.email'),
			'phone'                         => __('admin.phone'),
			'whatsapp'                      => __('admin.whatts_app_number'),
			'logo'                          => __('admin.logo_image'),
			'fav_icon'                      => __('admin.fav_icon_image'),
			'login_background'              => __('admin.background_image'),
			'default_user'                  => __('admin.virtual_user_image'),
			'smtp_user_name'                => __('admin.user_name'),
			'smtp_password'                 => __('admin.password'),
			'smtp_mail_from'                => __('admin.email_Sender'),
			'smtp_sender_name'              => __('admin.the_sender_name'),
			'smtp_host'                     => __('admin.the_nouns_al'),
			'smtp_encryption'               => __('admin.encryption_type'),
			'smtp_port'                     => __('admin.Port_number'),
			'firebase_key'                  => __('admin.server_key'),
			'firebase_sender_id'            => __('admin.sender_identification'),
			'google_analytics'              => __('admin.google_analytics'),
			'google_places'                 => __('admin.google_places'),
			'max_distance'                  => __('admin.max_distance'),
			'vat'                           => __('admin.vat_value'),
			'administration_fee_percentage' => __('admin.administration_fee_percentage'),
		];
	}
}
