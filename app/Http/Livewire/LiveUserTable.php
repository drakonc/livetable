<?php

namespace App\Http\Livewire;

use App\Models\User;
use Livewire\{Component, WithPagination};


class LiveUserTable extends Component
{
    use WithPagination;

    public $search = '';
    public $perPage = 15;
    public $camp = null;
    public $order = null;
    public $icon = 'circle';

    public function render()
    {
        $users = User::where('name','like', "%{$this->search}%")
                ->orWhere('email','like', "%{$this->search}%");

        if($this->camp && $this->order){
            $users = $users->orderBy($this->camp,$this->order);
        }

        $users = $users->paginate($this->perPage);
        return view('livewire.live-user-table')->with('users',$users);
    }

    public function sortable($camp){
        switch($this->order){
            case null:
                $this->order = 'asc';
                $this->icon = 'arrow-circle-up';
                break;
            case 'asc':
                $this->order = 'desc';
                $this->icon = 'arrow-circle-down';
                break;
            case 'desc':
                $this->order = null;
                $this->icon = 'circle';
                break;
        }
        $this->camp = $camp;
    }

}
