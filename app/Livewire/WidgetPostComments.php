<?php

namespace App\Livewire;

use App\Models\Post;
use App\Models\Comment;
use Livewire\Component;

class WidgetPostComments extends Component
{
    public $type;
    public $post;
    public $slug;
    public $options;
    public $name;
    public $email;
    public $content;

    public function mount($slug, $type, $options)
    {
        $this->type = $type;
        $this->options = json_decode($options, true);
        $this->slug = $slug;

        if ($this->type == "single post") {
            $this->post = Post::where(['slug' => $slug])->first();
        }
    }

    public function submitComment()
    {
        $this->validate([
            'name' => 'required',
            'email' => 'required|email',
            'content' => 'required',
        ]);

        $comment = new Comment();
        $comment->name = $this->name;
        $comment->email = $this->email;
        $comment->text = $this->content;
        $comment->post_id = $this->post->id; // اضافه کردن ارتباط با پست
        $comment->save();

        // پس از ذخیره کردن نظر، مقادیر فیلد‌ها را صفر یا خالی کنید
        $this->name = '';
        $this->email = '';
        $this->content = '';

        // رفرش کردن کامپوننت پس از ارسال نظر
        $this->post = Post::find($this->post->id);
    }

    public function render()
    {
        $post = $this->post;
        return view('livewire.widget-post-comments');
    }
}
