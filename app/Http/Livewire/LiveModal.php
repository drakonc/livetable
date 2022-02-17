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
    public $method = '';
    public $action = '';
    public $title = '';


    public $options = [
        'admin' => 'Administrator', 
        'seller' => 'Vendedor', 
        'client' => 'Cliente'
    ];

    protected $listeners = [
        'showModal' => 'abrirModal',
        'showModalNewUser' => 'abrirModalNuevo'
    ];

    public function abrirModal(User $user){
        $this->user = $user;
        $this->name = $user->name;
        $this->lastname = $user->r_lastname->lastname;
        $this->email = $user->email;
        $this->role = $user->role;
        $this->action = 'Actualizar';
        $this->title = 'Edicion de Usuario';
        $this->method = 'actualizarUsuario()';
        $this->hidden = '';
    }

    public function abrirModalNuevo(){
        $this->user = null;
        $this->action = 'Registrar';
        $this->title = 'Registro de Usuario';
        $this->method = 'registrarUsuario()';
        $this->hidden = '';
    }
    
    public function registrarUsuario(){
        $requestUser = new RequestUpdateUser();
        $values = $this->validate($requestUser->rules($this->user),$requestUser->messages());
        $this->cerrarModal();
    }
    
    public function actualizarUsuario(){
        $requestUser = new RequestUpdateUser();
        $values = $this->validate($requestUser->rules(),$requestUser->messages());
        $this->user->update($values);
        $this->user->r_lastname()->update(['lastname'=>$values['lastname']]);
        $this->emit('userListUpdate');
        $this->cerrarModal();
    }

    public function updated($label) {
        $requestUser = new RequestUpdateUser();
        $this->validateOnly($label,$requestUser->rules($this->user),$requestUser->messages());
    }

    public function cerrarModal() {
        $this->resetErrorBag();
        $this->resetValidation();
        $this->reset();
    }

    public function render(){
        return view('livewire.live-modal');
    }
}
