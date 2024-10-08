<?php

namespace App\View\Components\Admin\Inputs;

use Illuminate\View\Component;

class SubmitButton extends Component
{
	/**
	 * Create a new component instance.
	 *
	 * @return void
	 */
	public $name, $color;

	public function __construct($name = '', $color = 'primary')
	{
		$this->name           = empty($name) ? __('admin.add') : $name;
		$this->color   = $color;
	}

	/**
	 * Get the view / contents that represent the component.
	 *
	 * @return \Illuminate\View\View|string
	 */
	public function render()
	{
		return view('components.admin.inputs.submitButton');
	}
}
