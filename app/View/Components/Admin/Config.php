<?php

namespace App\View\Components\Admin;

use Illuminate\View\Component;

class Config extends Component
{
	/**
	 * Create a new component instance.
	 *
	 * @return void
	 */
	public $sweetAlert2, $select2, $datePickr, $table, $validation, $stepper, $ckeditor, $toastr, $scrollbar;

	public function __construct($sweetAlert2 = false, $select2 = false, $datePickr = false, $table = false, $validation = false, $stepper = false, $ckeditor = false, $toastr = false, $scrollbar = false)
	{
		$this->sweetAlert2 = $sweetAlert2;
		$this->select2     = $select2;
		$this->datePickr   = $datePickr;
		$this->table       = $table;
		$this->validation  = $validation;
		$this->stepper     = $stepper;
		$this->ckeditor    = $ckeditor;
		$this->toastr    = $toastr;
		$this->scrollbar    = $scrollbar;
	}

	/**
	 * Get the view / contents that represent the component.
	 *
	 * @return \Illuminate\View\View|string
	 */
	public function render()
	{
		return view('components.admin.config');
	}
}
