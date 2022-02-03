<?php

namespace App\Http\Livewire;

use App\Models\User;
use Livewire\{Component, WithPagination};


class LiveUserTable extends Component
{
    use WithPagination;

    public function render()
    {
        return view('livewire.live-user-table', ['users' => User::paginate(5)]);
    }
}
