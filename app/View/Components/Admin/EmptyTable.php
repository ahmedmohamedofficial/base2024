<?php

namespace App\View\Components\Admin;

use Illuminate\View\Component;

class EmptyTable extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('components.admin.empty');
    }
}
