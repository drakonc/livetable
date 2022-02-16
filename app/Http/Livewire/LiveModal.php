<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Http\Requests\RequestUpdateUser;
use App\Models\{User, Apellido};

class LiveModal extends Component
{
    public $hidden = 'hidden';
    public $name = '';
    public $lastname = '';
    public $email = '';
    public $role = '';
    public $user = null;


    public $options = [
        'admin' => 'Administrator', 
        'seller' => 'Vendedor', 
        'client' => 'Cliente'
    ];

    protected $listeners = [
        'showModal' => 'abrirModal'
    ];

    public function abrirModal(User $user){
        $this->user = $user;
        $this->name = $user->name;
        $this->lastname = $user->r_lastname->lastname;
        $this->email = $user->email;
        $this->role = $user->role;
        $this->hidden = '';
    }
    
    public function cerrarModal() {
        $this->reset();
    }
    
    public function actualizarUsuario(){
        $requestUser = new RequestUpdateUser();
        $values = $this->validate($requestUser->rules(),$requestUser->messages());
        $this->user->update($values);
        $this->user->r_lastname()->update(['lastname'=>$values['lastname']]);
        $this->emit('userListUpdate');
        $this->reset();
    }

    public function updated($label) {
        $requestUser = new RequestUpdateUser();
        $this->validateOnly($label,$requestUser->rules(),$requestUser->messages());
    }

    public function render(){
        return view('livewire.live-modal');
    }
}
