<?php

namespace App\View\Components\Admin\Inputs;

use Illuminate\View\Component;

class Textarea extends Component
{
	/**
	 * Create a new component instance.
	 *
	 * @return void
	 */
	public $className, $name, $label, $placeholder, $validMessage, $inValidMessage, $value, $cols, $rows, $required, $disabled, $idName;

	public function __construct($className = 'form-control', $name = '', $label = '', $placeholder = '', $validMessage = '', $inValidMessage = '', $value = null, $cols = 30, $rows = 10, $required = false, $disabled = false, $idName = false)
	{
		$this->className      = $className;
		$this->name           = $name;
		$this->label          = $label;
		$this->placeholder    = $placeholder;
		$this->validMessage   = $validMessage;
		$this->inValidMessage = $inValidMessage;
		$this->value          = $value;
		$this->cols           = $cols;
		$this->rows           = $rows;
		$this->required       = $required;
		$this->disabled       = $disabled;
		$this->idName         = $idName;
	}

	/**
	 * Get the view / contents that represent the component.
	 *
	 * @return \Illuminate\View\View|string
	 */
	public function render()
	{
		return view('components.admin.inputs.textarea');
	}
}
