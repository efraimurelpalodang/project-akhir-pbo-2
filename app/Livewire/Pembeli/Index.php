<?php

namespace App\Livewire\Pembeli;

use App\Models\Pembeli;
use Livewire\Component;

class Index extends Component
{
    public function render()
    {
        return view('livewire.pembeli.index', [
            'pembelis' => Pembeli::latest()->get()
        ]);
    }
}
