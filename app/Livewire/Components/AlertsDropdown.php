<?php

namespace App\Livewire\Components;

use Livewire\Component;

class AlertsDropdown extends Component
{

    public $icon;
    public $counter;
    public $title;
    public $items = [];
    public $dropdownId;
    public $footerText;

    public function mount($icon, $counter, $title, $items, $dropdownId, $footerText)
    {
        $this->icon = $icon;
        $this->counter = $counter;
        $this->title = $title;
        $this->items = $items;
        $this->dropdownId = $dropdownId;
        $this->footerText = $footerText;
    }
    
    public function render()
    {
        return view('livewire.components.alerts-dropdown');
    }
}
