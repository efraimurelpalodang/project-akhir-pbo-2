<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class cardInfo extends Component
{
    /**
     * Create a new component instance.
     */
    public $title;
    public $value;
    public $color;
    public $icon;
    public $progress;

    public function __construct($title, $value, $color, $icon, $progress = null)
    {
        $this->title = $title;
        $this->value = $value;
        $this->color = $color;
        $this->icon = $icon;
        $this->progress = $progress;

    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.card-info');
    }
}
