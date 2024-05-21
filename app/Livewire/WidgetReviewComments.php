<?php
namespace App\Livewire;

use App\Models\Review;
use Livewire\Component;

class WidgetReviewComments extends Component
{
    public $type;
    public $review;
    public $slug;
    public $options;
    public $name;
    public $title;
    public $content;
    public $rating;

    public function mount($slug, $type, $options)
    {
        $this->type = $type;
        $this->options = json_decode($options, true);
        $this->slug = $slug;


    }

    public function submitComment()
    {
        $this->validate([
            'name' => 'required',
            'title' => 'required',
            'content' => 'required',
            'rating' => 'required',
        ]);

        $comment = new Review();
        $comment->name = $this->name;
        $comment->title = $this->title;
        $comment->text = $this->content;
        $comment->rating = $this->rating;
        $comment->product_id = $this->slug; // اضافه کردن ارتباط با محصول
        $comment->save();

        // پس از ذخیره کردن نظر، مقادیر فیلد‌ها را صفر یا خالی کنید
        $this->name = '';
        $this->title = '';
        $this->content = '';
        $this->rating = '';
        // رفرش کردن کامپوننت پس از ارسال نظر
        $this->review = Review::find($this->slug);
    }

    public function render()
    {
        $review = $this->review;
        return view('livewire.widget-review-comments');
    }
}
