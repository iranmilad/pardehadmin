<?php

namespace App\Livewire;

use Livewire\Component;

class RadioBox extends Component
{
    public $name;
    public $value;
    public $label;
    public $options;
    public $title;
    public $id;

    public function mount($title,$name, $options)
    {
        $this->title = $title;
        $this->name = $name;
        $this->label = $options['label'] ?? '';
        $this->value = $options['value'] ?? '';
        $this->id = $options['id'] ?? '';
    }

    public function render()
    {
        return view('livewire.radio-box');
    }
}
