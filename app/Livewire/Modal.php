<?php

namespace App\Livewire;

use Livewire\Component;

class Modal extends Component
{
    public $id;
    public $title;
    public $body;
    public $btnLeft;
    public $btnRight;

    public function mount($id, $body, $btnLeft, $btnRight, $title = '',)
    {
        $this->id = $id;
        $this->title = $title;
        $this->body = $body;
        $this->btnLeft = $btnLeft;
        $this->btnRight = $btnRight;
    }


    public function render()
    {
        return view('livewire.modal');
    }
}
