<?php

namespace App\View\Components;

use Illuminate\View\Component;

class ComponentInput extends Component
{

    public $label;
    public $placeholder;
    public $name;
    public $type;

    public function __construct(string $label, string $placeholder, string $name, string $type = 'text')
    {
        $this->label = $label;
        $this->placeholder = $placeholder;
        $this->name = $name;
        $this->type = $type;
    }


    public function render()
    {
        return view('components.component-input');
    }
}
