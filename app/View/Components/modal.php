<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class modal extends Component
{
    /**
     * Create a new component instance.
     */

    public $id;
    public $title;
    public $body;
    public $btnLeft;
    public $btnRight;

    public function __construct($id, $body, $btnLeft, $btnRight, $title = '',)
    {
        $this->id = $id;
        $this->title = $title;
        $this->body = $body;
        $this->btnLeft = $btnLeft;
        $this->btnRight = $btnRight;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.modal');
    }
}
