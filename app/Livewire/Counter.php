<?php

namespace App\Livewire;

use Livewire\Component;

class Counter extends Component
{
    public $x = false;
    public $options = [];


    public function save()
    {
        dd($this->x);
    }

    public function render()
    {
        return view('livewire.counter');
    }
}
