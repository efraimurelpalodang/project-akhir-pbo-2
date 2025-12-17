<?php

namespace App\View\Components\pengguna;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class FormModal extends Component
{
    /**
     * Create a new component instance.
     */
    public $id;
    public $title;
    public $rightBtn;
    public $event;
    public $perans;

    public function __construct($id = '', $title = '', $rightBtn = '', $event = '', $perans = '')
    {
        $this->id = $id;
        $this->title = $title;
        $this->rightBtn = $rightBtn;
        $this->event = $event;
        $this->perans = $perans;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.pengguna.form-modal');
    }
}
