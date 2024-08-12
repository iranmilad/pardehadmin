<?php
namespace App\Http\Controllers;

use App\Models\Review;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Traits\AuthorizeAccess;

class ReviewController extends Controller
{
    use AuthorizeAccess;

    public function __construct()
    {
        // تنظیم نام دسترسی مورد نیاز
        $this->permissionName = 'manage_reviews';
    }

    public function index(Request $request)
    {
        // ساختن کوئری برای Review
        $query = Review::query();

        // اعمال فیلتر بر اساس دسترسی‌های کاربر
        $query = $this->applyAccessControl($query);

        // فیلتر کردن براساس جستجو
        if ($request->has('s')) {
            $search = $request->get('s');
            $query->where('id', 'LIKE', "%{$search}%")
                  ->orWhereHas('user', function($q) use ($search) {
                      $q->where('first_name', 'LIKE', "%{$search}%");
                  })
                  ->orWhereHas('user', function($q) use ($search) {
                    $q->where('last_name', 'LIKE', "%{$search}%");
                });
        }

        // مرتب‌سازی بر اساس تاریخ ایجاد و صفحه‌بندی نتایج
        $reviews = $query->orderBy('created_at', 'desc')->paginate(10);

        return view('product-reviews', compact('reviews'));
    }

    public function create()
    {
        return view('product-review', ['products' => Product::all()]);
    }


    public function edit($id)
    {
        $review = Review::findOrFail($id);
        $this->authorizeAction($review);

        $product = $review->product;
        return view('product-review', compact('review', 'product'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'text' => 'required|string',
            'rating' => 'required|integer|min:0|max:5',
            'quality' => 'nullable|integer|min:0|max:5',
            'performance' => 'nullable|integer|min:0|max:5',
            'design' => 'nullable|integer|min:0|max:5',
            'price' => 'nullable|integer|min:0|max:5',
            'ease_of_use' => 'nullable|integer|min:0|max:5',
            'images' => 'nullable|array',
            'images.*' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'product_id' => 'required|exists:products,id',
            'status' => 'required|string|in:pending,approved,rejected',
        ]);

        $images = [];
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $path = $image->store('reviews', 'public');
                $images[] = $path;
            }
        }

        $review = new Review($validated);
        $review->images = json_encode($images);
        $review->user_id = auth()->id();
        $review->save();

        return redirect()->route('products.reviews.index')->with('success', 'Review created successfully.');
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'text' => 'required|string',
            'rating' => 'required|integer|min:0|max:5',
            'quality' => 'nullable|integer|min:0|max:5',
            'performance' => 'nullable|integer|min:0|max:5',
            'design' => 'nullable|integer|min:0|max:5',
            'price' => 'nullable|integer|min:0|max:5',
            'ease_of_use' => 'nullable|integer|min:0|max:5',
            'images' => 'nullable|array',
            'images.*' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'product_id' => 'required|exists:products,id',
            'status' => 'required|string|in:pending,approved,rejected',
        ]);

        $review = Review::findOrFail($id);
        $this->authorizeAction($review);

        $images = json_decode($review->images, true) ?? [];
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $path = $image->store('reviews', 'public');
                $images[] = $path;
            }
        }

        $review->fill($validated);
        $review->images = json_encode($images);
        $review->save();

        return redirect()->route('products.reviews.index')->with('success', 'Review updated successfully.');
    }


    public function destroy($id)
    {
        $review = Review::findOrFail($id);
        $this->authorizeAction($review);

        $review->delete();
        return redirect()->route('products.reviews.index')->with('success', 'Review deleted successfully.');
    }
}
