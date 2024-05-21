<?php

namespace App\Livewire;

use Livewire\Component;

class CheckboxCollapsible extends Component
{
    public $title;
    public $checkboxes;
    public $name;

    public function mount($name,$title, $checkboxes)
    {
        $this->title = $title;
        $this->checkboxes = $checkboxes;
        $this->name = $name;
    }

    public function render()
    {
        return view('livewire.checkbox-collapsible');
    }
}
