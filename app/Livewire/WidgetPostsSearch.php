<?php

namespace App\Livewire;

use Livewire\Component;

class WidgetPostsSearch extends Component
{
    public $type; // تعداد پست‌ها به عنوان یک props
    public $posts;
    public $options;
    public $searchTerm = ''; // عبارت جستجو را ذخیره می‌کنیم

    public function mount($type,$options)
    {
        $this->type = $type;
        $this->options = json_decode($options, true);
    }
    // تابع جستجو
    public function search()
    {
        // ارسال کردن کاربر به صفحه جستجو با عبارت تایپ شده
        return redirect()->to("/search/q?$this->searchTerm");
    }



    public function render()
    {
        return view('livewire.widget-posts-search');
    }
}
