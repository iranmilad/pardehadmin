<?php

namespace App\Livewire;



use Livewire\Component;
use App\Models\BlockWidget;

class LoadWidget extends Component
{
    public $blockId;
    public $slug; // ورودی غیرالزامی
    protected $rules = [
        'slug' => 'nullable', // اعلام کردن ورودی به عنوان غیرالزامی
    ];

    public function mount($blockId)
    {
        $this->blockId = $blockId;
    }

    public function render()
    {
        $block = BlockWidget::where('block', $this->blockId)->first();

        if (!$block) {
            return view('livewire.load-widget', ['component' => null]);
        }

        $widget = $block->widget;

        if (!$widget) {
            return view('livewire.load-widget', ['component' => null]);
        }

        $slug = $this->slug ?? null;


        return view('livewire.load-widget', ['component' => $widget->name, 'block' => $block,'slug' =>$slug]);
    }
}
