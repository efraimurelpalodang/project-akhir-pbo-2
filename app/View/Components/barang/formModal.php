<?php

namespace App\View\Components\barang;

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
    public $satuans;

    public function __construct($id = '', $title = '', $rightBtn = '', $event = '', $satuans = '')
    {
        $this->id = $id;
        $this->title = $title;
        $this->rightBtn = $rightBtn;
        $this->event = $event;
        $this->satuans = $satuans;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.barang.form-modal');
    }
}
