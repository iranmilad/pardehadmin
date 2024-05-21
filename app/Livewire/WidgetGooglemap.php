<?php

namespace App\Livewire;

use Livewire\Component;


class WidgetGooglemap extends Component
{

    public $type;
    public $googleMap;
    public $options;


    public function mount($type,$options)
    {
        $this->type = $type;
        $this->options = json_decode($options, true);

        if ($this->type == "simple") {
            $this->googleMap = (object)$this->options;
        }

    }



    public function render()
    {
        $googleMap= $this->googleMap;
        return view('livewire.widget-googlemap',compact('googleMap'));
    }
}
