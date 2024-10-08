<?php

namespace App\View\Components\Admin\Inputs;

use Illuminate\View\Component;

class Image extends Component
{
	/**
	 * Create a new component instance.
	 *
	 * @return void
	 */
	public $name, $validMessage, $inValidMessage, $required, $src, $disabled, $desc, $parameters;

	public function __construct($name = '', $validMessage = '', $inValidMessage = '', $required = false, $src = false, $disabled = false, $desc = '', $parameters = [])
	{
		$this->name           = $name;
		$this->validMessage   = $validMessage;
		$this->inValidMessage = $inValidMessage;
		$this->required       = $required;
		$this->src            = $src;
		$this->disabled       = $disabled;
		$this->desc           = $desc;
		$this->parameters     = $parameters;
	}

	/**
	 * Get the view / contents that represent the component.
	 *
	 * @return \Illuminate\View\View|string
	 */
	public function render()
	{
		return view('components.admin.inputs.image');
	}
}
