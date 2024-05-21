<?php

namespace App\View\Components;

use Closure;
use App\Models\Menu;
use Illuminate\View\Component;
use Illuminate\Contracts\View\View;

class MobileMenu extends Component
{
    public $menus;
    /**
     * Create a new component instance.
     */
    public function __construct($alias)
    {
        $this->menus  = Menu::where(['alias'=>$alias,])
        ->first();
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.mobile-menu');
    }
}
