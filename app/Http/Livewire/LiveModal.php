<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\{User, Apellido};

class LiveModal extends Component
{
    public $hidden = 'hidden';
    public $name = '';
    public $lastname = '';
    public $email = '';
    public $role = '';


    public $options = [
        'admin' => 'Administrator', 
        'seller' => 'Vendedor', 
        'client' => 'Cliente'
    ];

    protected $listeners = [
        'showModal' => 'abrirModal'
    ];

    public function abrirModal(User $user){
        $this->name = $user->name;
        $this->lastname = $user->r_lastname->lastname;
        $this->email = $user->email;
        $this->role = $user->role;
        $this->hidden = '';
    }
    
    public function cerrarModal() {
        $this->reset();
    }
    
    public function render()
    {
        return view('livewire.live-modal');
    }
}
