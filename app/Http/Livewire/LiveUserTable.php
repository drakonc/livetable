<?php

namespace App\Http\Livewire;

use App\Models\User;
use Livewire\{Component, WithPagination};


class LiveUserTable extends Component
{
    use WithPagination;

    public $search = '';
    public $perPage = 15;

    public function render()
    {
        $users = User::where('name','like', "%{$this->search}%")
                ->orWhere('email','like', "%{$this->search}%")
                ->paginate($this->perPage);
        return view('livewire.live-user-table')->with('users',$users);
    }
}
