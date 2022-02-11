<?php

namespace App\View\Components;

use Illuminate\View\Component;

class ComponantModal extends Component
{

    public $hidden;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(string $hidden)
    {
        $this->hidden = $hidden;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.componant-modal');
    }
}
