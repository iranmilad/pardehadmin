<?php

namespace App\Livewire;


use App\Models\Slider;
use Livewire\Component;

class WidgetSliders extends Component
{
    public $type;
    public $sliders;
    public $options;

    public function mount($type,$options)
    {
        $this->type = $type;
        $this->options = json_decode($options, true);

        $sliderName = $this->options['name'] ?? null;
        if ($this->type == "selection") {
            $imageIds = $this->options['images'] ?? [];
            $this->sliders = Slider::where('name', $sliderName)->get();
        }
        else{
            $this->sliders = Slider::where('name', $sliderName)->get();
        }


    }


    public function render()
    {
        $sliders= $this->sliders;
        return view('livewire.widget-sliders',compact('sliders'));
    }
}
