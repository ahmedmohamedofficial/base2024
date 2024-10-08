<?php

namespace App\View\Components\Admin\Inputs;

use Illuminate\View\Component;

class FormAjax extends Component
{
	/**
	 * Create a new component instance.
	 *
	 * @return void
	 */

	public $className;
	public function __construct($className = 'formAjax')
	{
		$this->className = $className;
	}

	/**
	 * Get the view / contents that represent the component.
	 *
	 * @return \Illuminate\View\View|string
	 */
	public function render()
	{
		return view('components.admin.inputs.formAjax');
	}
}
