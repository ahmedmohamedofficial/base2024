<?php

namespace App\View\Components\Admin;

use Illuminate\View\Component;

class Map extends Component
{
	/**
	 * Create a new component instance.
	 *
	 * @return void
	 */

	public $className;
	public function __construct ( public $map = 'map', public $lat = 'lat', public $lng = 'lng', public $address = 'address', public $mapSearch = 'mapSearch', public $currentLocation = true )
	{
		$this->map             = $map;
		$this->lat             = $lat;
		$this->lng             = $lng;
		$this->address         = $address;
		$this->mapSearch       = $mapSearch;
		$this->currentLocation = $currentLocation;
	}

	/**
	 * Get the view / contents that represent the component.
	 *
	 * @return \Illuminate\View\View|string
	 */
	public function render ()
	{
		return view( 'components.admin.map' );
	}
}
