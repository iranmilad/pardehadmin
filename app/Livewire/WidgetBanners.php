<?php

namespace App\Livewire;

use App\Models\Menu;
use App\Models\Banner;
use Livewire\Component;

class WidgetBanners extends Component
{
    public $type;
    public $banners;
    public $options;

    public function mount($type,$options)
    {
        $this->type = $type;
        $this->options = json_decode($options, true);

        if ($this->type == "selection") {
            $bannerName = $this->options['name'] ?? null;
            $imageIds = $this->options['images'] ?? [];

            $this->banners = Banner::where('name', $bannerName)
                ->whereHas('images', function ($query) use ($imageIds) {
                    $query->whereIn('id', $imageIds);
                })->get();
        }

    }


    public function render()
    {
        $banners= $this->banners;
        return view('livewire.widget-banners',compact('banners'));
    }
}
