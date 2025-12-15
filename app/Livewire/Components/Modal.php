<?php

namespace App\Livewire\Components;

use Livewire\Component;

class Modal extends Component
{
    public $id;
    public $title;
    public $btnLeft;
    public $btnRight;

    public function mount($id, $btnLeft, $btnRight, $title = '',)
    {
        $this->id = $id;
        $this->title = $title;
        $this->btnLeft = $btnLeft;
        $this->btnRight = $btnRight;
    }
    
    public function render()
    {
        return view('livewire.components.modal');
    }
}
