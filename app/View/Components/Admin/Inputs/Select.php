<?php

namespace App\View\Components\Admin\Inputs;

use Illuminate\View\Component;

class Select extends Component
{
	/**
	 * Create a new component instance.
	 *
	 * @return void
	 */
	public $className, $name, $label, $placeholder, $validMessage, $inValidMessage, $value, $required, $disabled, $type, $parameters, $options, $idName, $multiple, $multiplesValues;

	public function __construct($className = 'select2 form-select form-select-lg select2-hidden-accessible', $name = '', $label = '', $placeholder = '', $validMessage = '', $inValidMessage = '', $value = null, $required = false, $disabled = false, $type = 'text', $parameters = [], $options = [], $idName = false, $multiple = false, $multiplesValues = '')
	{
		$this->name            = $name;
		$this->label           = $label;
		$this->placeholder     = $placeholder;
		$this->className       = $className;
		$this->validMessage    = $validMessage;
		$this->inValidMessage  = $inValidMessage;
		$this->value           = $value;
		$this->required        = $required;
		$this->disabled        = $disabled;
		$this->type            = $type;
		$this->parameters      = $parameters;
		$this->options         = $options;
		$this->idName          = $idName;
		$this->multiple        = $multiple;
		$this->multiplesValues = $multiplesValues;
	}

	/**
	 * Get the view / contents that represent the component.
	 *
	 * @return \Illuminate\View\View|string
	 */
	public function render()
	{
		return view('components.admin.inputs.select');
	}
}
