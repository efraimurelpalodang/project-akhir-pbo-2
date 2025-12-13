<?php

namespace App\Livewire\Components;

use Livewire\Component;

class CardInfo extends Component
{
    public $title;
    public $value;
    public $color;
    public $icon;
    public $progress;

    public function mount($title, $value, $color, $icon, $progress = null)
    {
        $this->title = $title;
        $this->value = $value;
        $this->color = $color;
        $this->icon = $icon;
        $this->progress = $progress;
    }
    
    public function render()
    {
        return view('livewire.components.card-info');
    }
}
