<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Rating extends Component
{
    /**
     * Create a new component instance.
     */
    public $readOnly;
    public $rate;
    public $name;
    public function __construct($readOnly = false, $rate = 0, $name = 'rate')
    {
        $this->readOnly = $readOnly;
        $this->rate = $rate;
        $this->name = $name;
    }
    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.rating', [
            'readOnly' => $this->readOnly,
            'rate' => $this->rate,
            'name' => $this->name
        ]);
    }
}
