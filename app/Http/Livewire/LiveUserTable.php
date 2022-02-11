<?php

namespace App\Http\Livewire;

use App\Models\{User, Apellido};
use Livewire\{Component, WithPagination};


class LiveUserTable extends Component
{
    use WithPagination;

    public $buscar = '';
    public $perPage = 15;
    public $user_role = "";
    public $camp = null;
    public $order = null;
    public $icon = 'circle';

    protected $queryString = [
        'buscar' => ['except' => ''],
        'camp' => ['except' => null],
        'order' => ['except' => null]

    ];

    public function render()
    {
        $users = User::termino($this->buscar)->role($this->user_role);

        if($this->camp && $this->order){
            if($this->camp == 'lastname'){
               $users = $users->orderBy(Apellido::select($this->camp)->whereColumn('apellidos.user_id','users.id'),$this->order);
            }else{
                $users = $users->orderBy($this->camp,$this->order);
            }
        }else{
            $this->camp = null;
            $this->order = null;
        }

        $users = $users->paginate($this->perPage);
        return view('livewire.live-user-table')->with('users',$users);
    }

    public function updatingBuscar(){
        $this->resetPage();
    }

    public function mount(){
        $this->icon = $this->iconDirection($this->order);
    }

    public function clear(){
        $this->reset();
    }

    public function sortable($camp){
        if($camp !== $this->camp){
            $this->order = null;
        }
        switch($this->order){
            case null:
                $this->order = 'asc';
                break;
            case 'asc':
                $this->order = 'desc';
                break;
            case 'desc':
                $this->order = null;
                break;
        }
        $this->icon = $this->iconDirection($this->order);
        $this->camp = $camp;
    }

    public function iconDirection($sort): string{
        if(!$sort)
            return 'circle';

        return $sort === 'asc' ? 'arrow-circle-up':'arrow-circle-down';
    }

    public function showModal(User $user){
        $this->emit('showModal',$user);
    }
}
