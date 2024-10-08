<?php

namespace App\View\Components\Admin\Inputs;

use Illuminate\View\Component;

class Password extends Component
{
	/**
	 * Create a new component instance.
	 *
	 * @return void
	 */
	public $className, $name, $label, $validMessage, $inValidMessage, $required, $parameters, $value;

	public function __construct($className = 'form-control', $name = '', $label = '', $validMessage = '', $inValidMessage = '', $required = false, $parameters = [], $value= '')
	{
		$this->className      = $className;
		$this->name           = $name;
		$this->label          = $label;
		$this->validMessage   = $validMessage;
		$this->inValidMessage = $inValidMessage;
		$this->required       = $required;
		$this->parameters     = $parameters;
		$this->value     = $value;
	}

	/**
	 * Get the view / contents that represent the component.
	 *
	 * @return \Illuminate\View\View|string
	 */
	public function render()
	{
		return view('components.admin.inputs.password');
	}
}
