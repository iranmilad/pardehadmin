<?php

namespace App\View\Components;

use App\Models\Menu;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class HomeCategoryMenu extends Component
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
        return view('components.home-category-menu', ['menus' => $this->menus]);
    }
}
