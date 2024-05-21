<?php

namespace App\Livewire;


use App\Models\PostCategory;
use Livewire\Component;

class WidgetPostCategory extends Component
{
    public $type;
    public $categories;
    public $slug;
    public $options;

    public function mount($slug, $type, $options)
    {
        $this->type = $type;
        $this->options = json_decode($options, true);
        $this->slug = $slug;

        if ($this->type == "posts category") {
            $this->categories = PostCategory::all();
        }
    }

    public function render()
    {
        $categories = $this->categories;
        return view('livewire.widget-post-category');
    }
}
