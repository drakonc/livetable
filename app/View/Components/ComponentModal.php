<?php

namespace App\View\Components;

use Illuminate\View\Component;

class ComponentModal extends Component
{
    public $hidden;
    public $action;


    public function __construct(string $hidden, string $action)
    {
        $this->hidden = $hidden;
        $this->action = $action;
    }

    public function render()
    {
        return view('components.component-modal');
    }
}
