<?php

namespace App\Livewire;

use Livewire\Component;


class WidgetContactInfo extends Component
{

    public $type;
    public $contactInfo;
    public $options;

    public function mount($type,$options)
    {
        $this->type = $type;
        $this->options = json_decode($options, true);

        if ($this->type == "simple") {
            $this->contactInfo = (object)$this->options;
        }

    }



    public function render()
    {
        $contactInfo= $this->contactInfo;
        return view('livewire.widget-contact-info',compact('contactInfo'));
    }
}
