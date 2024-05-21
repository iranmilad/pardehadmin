<?php

namespace App\Livewire;

use App\Models\Product;
use App\Models\Review;
use Livewire\Component;
use Livewire\WithPagination;

class WidgetReviewsList extends Component
{
    use WithPagination;
    private $type= "new review";
    private $reviews;
    public $slug;
    public $options;
    public $name;
    public $title;
    public $text;
    private $product;
    protected $paginationTheme = 'bootstrap';



    public function mount($slug, $type, $options)
    {
        $this->type = $type;
        $this->options = json_decode($options, true);
        $this->slug = $slug;
        $this->product = Product::find($slug);

        $count = $this->options['count'] ?? 10;

        if ($this->type == "new review") {

            $this->reviews = $this->product->reviews()->latest()->paginate($count);
        }
    }

    public function submitReviews()
    {
        $this->validate([
            'name' => 'required',
            'title' => 'required|title',
            'text' => 'required',
        ]);

        $reviews = new Review();
        $reviews->name = $this->name;
        $reviews->title = $this->title;
        $reviews->text = $this->text;
        $reviews->product_id = $this->product->id; // اضافه کردن ارتباط با پست
        $reviews->save();

        // پس از ذخیره کردن نظر، مقادیر فیلد‌ها را صفر یا خالی کنید
        $this->name = '';
        $this->title = '';
        $this->text = '';

        // رفرش کردن کامپوننت پس از ارسال نظر
        $this->reviews = Product::find($this->product->id)->reviews();
    }


    public function render()
    {
        $this->product = Product::find($this->slug);
        $reviews = $this->product->reviews()->latest()->paginate(10);;

        return view('livewire.widget-reviews-list', [
            'reviews' => $reviews
        ]);
    }
}
