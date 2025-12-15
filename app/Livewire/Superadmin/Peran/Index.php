<?php

namespace App\Livewire\Superadmin\Peran;

use App\Models\Role;
use Livewire\Component;

class Index extends Component
{
    public function render()
    {
        return view('livewire.superadmin.peran.index',[
            'perans' => Role::latest()->get()
        ]
    );
    }
}
