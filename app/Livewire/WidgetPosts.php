<?php
namespace App\Livewire;

use App\Models\Post;
use Livewire\Component;

class WidgetPosts extends Component
{
    public $type; // تعداد پست‌ها به عنوان یک props
    public $posts;
    public $options;

    public function mount($type,$options)
    {
        $this->type = $type;
        $this->options = json_decode($options, true);
        $count = $this->options['count'] ?? 4;

        if ($this->type == "new post") {
            $this->posts = Post::latest()->take($count)->get();
        }
        elseif ($this->type == 'category') {
            // یک پست تصادفی از دسته‌بندی مشخص شده بگیرید
            $category = $this->options['category'] ?? null;
            if ($category) {
                $this->posts = Post::whereHas('categories', function($query) use ($category) {
                    $query->where('name', $category);
                })->inRandomOrder()->take($count)->get();
            }
        }
        elseif ($this->type == 'popular post') {
            // پست‌ها را بر اساس تعداد بازدید مرتب کنید
            $this->posts = Post::orderBy('views', 'desc')->take($count)->get();
        }
    }

    public function render()
    {
        $posts = $this->posts;
        return view('livewire.widget-posts', compact('posts'));
    }
}
