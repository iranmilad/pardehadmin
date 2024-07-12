<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class fileInput extends Component
{
    /**
     * Create a new component instance.
     */
    public $type;
    public $preview;
    public $name;
    public function __construct($type,$preview = false,$name)
    {
        $this->type = $type;
        $this->preview = $preview;
        $this->name = $name;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.file-input');
    }
}