<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\{User, Apellido};
use Illuminate\Support\Facades\DB;
use Livewire\TemporaryUploadedFile;
use App\Http\Requests\RequestUpdateUser;
use Illuminate\Support\Facades\Storage;

class LiveModal extends Component
{

    use WithFileUploads;

    public $hidden = 'hidden';
    public $name = '';
    public $lastname = '';
    public $email = '';
    public $role = '';
    public $password = '';
    public $password_confirmation = '';
    public $user = null;
    public $method = '';
    public $action = '';
    public $title = '';
    public $profile_photo_path = null;


    public $options = [
        'admin' => 'Administrator', 
        'seller' => 'Vendedor', 
        'client' => 'Cliente'
    ];

    protected $listeners = [
        'showModalUpdateUser' => 'abrirModal',
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
        $user = new User;
        $apellido = new Apellido;
        $apellido->lastname = $values['lastname'];
        $user->fill($values);
        $user->password = bcrypt($values['password']);
        if($values['profile_photo_path']){
            $user->profile_photo_path = $this->loadImage($values['profile_photo_path']);
        }
        DB::transaction(function () use ($user,$apellido) {
            $user->save();
            $apellido->r_user()->associate($user)->save();
        });
        $this->cerrarModal();
    }
    
    public function actualizarUsuario(){
        $requestUser = new RequestUpdateUser();
        $values = $this->validate($requestUser->rules($this->user),$requestUser->messages());
        if($values['profile_photo_path']){
            if($this->user->profile_photo_path){
                $this->removeImage($this->user->profile_photo_path);
            }
            $profile = ['profile_photo_path' => $this->loadImage($values['profile_photo_path'])];
            $values = array_merge($values,$profile);
        }else{
            $profile = ['profile_photo_path' => $this->user->profile_photo_path];
            $values = array_merge($values,$profile);
        }

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

    private function loadImage(TemporaryUploadedFile $imagen){
        $location = Storage::disk('public')->put('img',$imagen);
        return $location;
    }

    private function removeImage(string $profile_photo_path){
        if(!$profile_photo_path) {
            return;
        }

        if(Storage::disk('public')->exists($profile_photo_path)){
            Storage::disk('public')->delete($profile_photo_path);
        }
    }

    public function render(){
        return view('livewire.live-modal');
    }
}
