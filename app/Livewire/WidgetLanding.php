<?php

namespace App\Livewire;


use Livewire\Component;

class WidgetLanding extends Component
{
    public $type;
    public $landing;
    public $options;

    public function mount($type,$options)
    {
        $this->type = $type;
        $this->options = json_decode($options, true);

        if ($this->type == "image") {
            $this->landing = (object)$this->options;
        }

    }


    public function render()
    {
        $landing= $this->landing;
        return view('livewire.widget-landing',compact('landing'));
    }
}
