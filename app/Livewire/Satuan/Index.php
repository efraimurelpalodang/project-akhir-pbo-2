<?php

namespace App\Livewire\Satuan;

use App\Models\Satuan;
use Livewire\Component;

class Index extends Component
{
    public function render()
    {
        return view('livewire.satuan.index', [
            'satuans' => Satuan::latest()->get(),
            'title' => 'satuan'
        ]);
    }
}
