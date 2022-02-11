<?php

namespace App\Http\Livewire;

use Livewire\Component;

class LiveModal extends Component
{
    public $hidden = ''; 

    protected $listeners = [
        'showModal' => 'abrirModal'
    ];

    public function abrirModal($user){
        $this->hidden = '';
    }
    
    public function cerrarModal() {
        $this->hidden = 'hidden';
    }
    
    public function render()
    {
        return view('livewire.live-modal');
    }
}
