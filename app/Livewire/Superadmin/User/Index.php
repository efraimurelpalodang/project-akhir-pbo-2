<?php

namespace App\Livewire\Superadmin\User;

use App\Models\Pengguna;
use Livewire\Component;

class Index extends Component
{
    public function render()
    {
        return view('livewire.superadmin.user.index', [
            'penggunas' => Pengguna::latest()->get()
        ]);
    }
}
