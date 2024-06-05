<?php

namespace App\View\Components;

use Illuminate\View\Component;

class AdvancedSearch extends Component
{
    public $type;
    public $label;
    public $name;
    public $multiple;
    public $solid;
    public $classes;
    public $selected;

    /**
     * Create a new component instance.
     *
     * @param  string  $type
     * @param  string  $label
     * @param  string  $name
     * @return void
     */
    public function __construct($type, $label, $name, $multiple = false, $solid = false, $classes = "",$selected=[])
    {
        $this->type = $type;
        $this->label = $label;
        $this->name = $name;
        $this->multiple = $multiple;
        $this->solid = $solid;
        $this->classes = $classes;
        $this->selected= $selected;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('components.advanced-search',[
            'type' => $this->type,
            'label' => $this->label,
            'name' => $this->name,
            'multiple' => $this->multiple,
            'solid' => $this->solid,
            'classes' => $this->classes,
            'selected' => $this->selected, // ارسال مقدار selected به view
        ]);
    }
}
