<?php
// app/Livewire/WidgetPostInfo.php

namespace App\Livewire;

use App\Models\Post;
use Livewire\Component;

class WidgetPostInfo extends Component
{
    public $type;
    public $post;
    public $slug;
    public $options;

    public function mount($slug, $type, $options)
    {
        $this->type = $type;
        $this->options = json_decode($options, true);
        $this->slug = $slug;



        if ($this->type == "single post") {
            $this->post = Post::where(['slug' => $slug])->first();
        }
    }

    public function render()
    {
        $post = $this->post;
        return view('livewire.widget-post-info', compact('post'));
    }
}
