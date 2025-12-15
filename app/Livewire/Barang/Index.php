<?php

namespace App\Livewire\Barang;

use App\Models\Barang;
use Livewire\Component;

class Index extends Component
{
    public function render()
    {
        return view('livewire.barang.index', [
            'barangs' => Barang::latest()->get()
        ]);
    }
}
