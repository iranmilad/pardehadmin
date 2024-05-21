<?php

namespace App\Livewire;

use App\Models\Page;
use Livewire\Component;

class WidgetPageTitle extends Component
{
    public $type;
    public $page;
    public $options;

    public function mount($type, $options)
    {
        $this->type = $type;
        $this->options = json_decode($options, true);


        if ($this->type == "single page") {
            $this->page = Page::where(['url' => $this->options['link']])->first();
        }
    }

    public function render()
    {
        $page = $this->page;
        return view('livewire.widget-page-title',compact('page'));
    }
}
