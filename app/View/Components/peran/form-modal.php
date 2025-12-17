<?php

namespace App\View\Components\peran;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class formModal extends Component
{
    /**
     * Create a new component instance.
     */
    public $id;
    public $title;
    public $rightBtn;
    public $event;

    public function __construct($id = '', $title = '', $rightBtn = '', $event = '')
    {
        $this->id = $id;
        $this->title = $title;
        $this->rightBtn = $rightBtn;
        $this->event = $event;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.peran.form-modal');
    }
}
