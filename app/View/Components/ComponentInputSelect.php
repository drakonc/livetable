<?php

namespace App\View\Components;

use Illuminate\View\Component;

class ComponentInputSelect extends Component
{
    public $name;
    public $label;
    public $options;

    public function __construct(string $name, string $label, array $options)
    {
        $this->name = $name;
        $this->label = $label;
        $this->options = $options;
    }


    public function render()
    {
        return view('components.component-input-select');
    }
}
