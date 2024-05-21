<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class SweetAlert extends Component
{
    /**
     * Create a new component instance.
     */
    public $msg;
    public $title;
    public $icon;
    public $confirmButtonText;
    public function __construct($msg="", $title = '', $icon = 'success', $confirmButtonText = 'باشه')
    {
        $this->msg = $msg;
        $this->title = $title;
        $this->icon = $icon;
        $this->confirmButtonText = $confirmButtonText;
    }
    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.sweet-alert');
    }
}
