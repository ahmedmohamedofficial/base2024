<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class IsoCodeSeeders extends Seeder
{
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		$remote = isset($_SERVER["REMOTE_ADDR"]) ?? false;
		$url = 'database/seeders/json/iso.json' ;

		$isoJson =  json_decode(file_get_contents($url,true)); 

		$iso = array_map(function ($value) {
			return [
				'iso2'       =>  strtoupper($value->alpha2),
				'iso3'       =>  strtoupper($value->alpha3),
				'name'       =>  $value->name 
			];
		}, $isoJson );

		DB::table('iso_codes')->insert($iso) ;
	}
}
