<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class alerts extends Component
{
    /**
     * Create a new component instance.
     */
    public $icon;
    public $counter;
    public $title;
    public $items;
    public $dropdownId;
    public $footerText;

    public function __construct($icon, $counter, $title, $items, $dropdownId, $footerText)
    {
        $this->icon = $icon;
        $this->counter = $counter;
        $this->title = $title;
        $this->items = $items;
        $this->dropdownId = $dropdownId;
        $this->footerText = $footerText;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.alerts');
    }
}
