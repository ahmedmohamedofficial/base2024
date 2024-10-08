<?php

namespace App\View\Components\Admin;

use Illuminate\View\Component;

class FooterTable extends Component
{
	/**
	 * Create a new component instance.
	 *
	 * @return void
	 */
	public $rows;

	public function __construct($rows)
	{
		$this->rows = $rows;
	}

	/**
	 * Get the view / contents that represent the component.
	 *
	 * @return \Illuminate\View\View|string
	 */
	public function render()
	{
		return view('components.admin.footerTable');
	}
}
