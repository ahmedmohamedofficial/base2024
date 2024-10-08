<?php

use App\Models\SiteSetting;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Cache;
use App\Services\SettingService;

class CreateSiteSettingsTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema ::create( 'site_settings', function ( Blueprint $table ) {
			$table -> increments( 'id' );
			$table -> string( 'key', 50 );
			$table -> longText( 'value' );
			$table -> timestamps();
		} );
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema ::dropIfExists( 'site_settings' );
	}
}
