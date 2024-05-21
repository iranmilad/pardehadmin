<?php

namespace App\Livewire;

use App\Models\Page;
use Livewire\Component;
use Illuminate\Support\Facades\Blade;

class WidgetPageContent extends Component
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
        $compiledContent = Blade::compileString($page->content);
        return view('livewire.widget-page-content',compact('page','compiledContent'));
    }
}
