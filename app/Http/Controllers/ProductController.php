<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use App\Models\Review;
use App\Models\Product;
use App\Models\Category;
use App\Models\Attribute;
use App\Models\ProductImage;
use Illuminate\Http\Request;
use App\Traits\AuthorizeAccess;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    use AuthorizeAccess;

    public function __construct()
    {
        // تنظیم نام دسترسی مورد نیاز
        $this->permissionName = 'manage_products';
    }

    // نمایش لیست محصولات
    public function index(Request $request)
    {
        // ساختن کوئری برای Product
        $query = Product::with(['categories', 'tags']);

        // اعمال فیلتر بر اساس دسترسی‌های کاربر
        $query = $this->applyAccessControl($query);

        // فیلتر کردن براساس جستجو
        $searchQuery = $request->input('s');
        if ($searchQuery) {
            $query->where('title', 'LIKE', "%{$searchQuery}%");
        }

        // صفحه‌بندی نتایج
        $products = $query->paginate(6);

        return view('products', compact('products'));
    }

    // نمایش فرم ایجاد محصول
    public function create()
    {
        $categories = Category::all();
        $attributes = Attribute::all();
        $tags = Tag::all();

        return view('product', compact('categories', 'tags','attributes'));
    }


    public function store(Request $request)
    {
        // Validate input data
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'nullable|numeric',
            'sale_price' => 'nullable|numeric',
            'gallery' => 'nullable|array',
            'gallery.*' => 'nullable|string',
            'video_path' => 'nullable|string',
            'categories' => 'nullable|array',
            'categories.*' => 'nullable|integer|exists:categories,id',
            'tags' => 'nullable|string',
            'status' => 'required|string|in:published,inactive', // Validate status
            'reviews_enabled' => 'nullable|boolean', // Validate reviews_enabled
        ]);
        // افزودن user_id به داده‌ها
        $data['user_id'] = Auth::id();
        // Create product instance
        $product = Product::create($data);
        $data['reviews_enabled'] = $request->has('reviews_enabled') ? $request->input('reviews_enabled') : 0;

        // Handle gallery images paths and association
        if ($request->has('gallery')) {
            $galleryPaths = $request->input('gallery');
            foreach ($galleryPaths as $galleryPath) {
                // Ensure gallery path is a valid string and not empty
                if (!empty($galleryPath) && is_string($galleryPath)) {
                    // Create a new image instance and associate with the product
                    $image = new ProductImage(['url' => $galleryPath]);
                    $product->images()->save($image);
                }
            }
        }

        // Synchronize categories if provided
        if ($request->has('categories')) {
            $product->categories()->sync($request->input('categories'));
        }

        // Synchronize tags if provided
        if ($request->has('tags')) {
            $tags = json_decode($request->input('tags'), true);
            $tagIds = collect($tags)->map(function ($tagName) {
                $tag = Tag::firstOrCreate(['name' => $tagName["value"], 'description' => $tagName["value"], 'type' => 'ability']);
                return $tag->id;
            });

            $product->tags()->sync($tagIds);
        }

        // Redirect back with success message
        return redirect()->route('products.edit', $product->id)->with('success', 'محصول با موفقیت ایجاد شد.');
    }

    public function update(Request $request, $id)
    {
        //dd($request);
        // Load the product
        $product = Product::findOrFail($id);
        $this->authorizeAction($product);

        $data = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'nullable|numeric',
            'sale_price' => 'nullable|numeric',
            'img' => 'nullable|string',
            'gallery' => 'nullable|array',
            'gallery.*' => 'nullable|string',
            'video_path' => 'nullable|string',
            'categories' => 'nullable|array',
            'categories.*' => 'nullable|integer|exists:categories,id',
            'tags' => 'nullable|string',
            'status' => 'required|string|in:published,inactive', // Validate status
            'reviews_enabled' => 'nullable|boolean', // Validate reviews_enabled
            'service'=> 'required|boolean', // Validate service
        ]);

        $data['reviews_enabled'] = $request->has('reviews_enabled') ? $request->input('reviews_enabled') : 0;

        // Update product details
        $product->update($data);

        // Update categories if provided
        if ($request->has('categories')) {
            $product->categories()->sync($request->input('categories'));
        }

        // Update tags if provided
        if ($request->has('tags')) {
            $tags = json_decode($request->input('tags'), true);
            $tagIds = collect($tags)->map(function ($tagName) {
                $tag = Tag::firstOrCreate(['name' => $tagName["value"], 'description' => $tagName["value"], 'type' => 'ability']);
                return $tag->id;
            });
            $product->tags()->sync($tagIds);
        }



        // Handle gallery images paths and association
        if ($request->has('gallery')) {
            $galleryPaths = $request->input('gallery');
            $product->images()->delete(); // Optionally clear existing images if needed
            foreach ($galleryPaths as $galleryPath) {
                if (!empty($galleryPath) && is_string($galleryPath)) {
                    $image = new ProductImage(['url' => $galleryPath]);
                    $product->images()->save($image);
                }
            }
        }


        // Redirect back with success message
        return redirect()->route('products.edit', $product->id)->with('success', 'محصول با موفقیت به‌روزرسانی شد.');
    }

    // نمایش فرم ویرایش محصول
    public function edit($id)
    {
        $product = Product::with(['categories', 'tags'])->findOrFail($id);
        $this->authorizeAction($product);
        $categories = Category::all();
        $tags = Tag::all();
        $attributes = Attribute::all();
        $attributeOptions = Attribute::with('items')->get()->mapWithKeys(function ($attribute) use ($product) {
            return [
                $attribute->id => [
                    'name' => $attribute->name,
                    'options' => $attribute->items->map(function ($item) use ($product) {
                        return [
                            'id' => $item->id,
                            'name' => $item->name,
                            'selected' => $product->attributes->contains($item->id)
                        ];
                    })->toArray()
                ]
            ];
        })->toArray();

        return view('product', compact('product', 'categories', 'tags','attributes', 'attributeOptions'));
    }

    // حذف محصول
    public function delete(Request $request)
    {
        $product = Product::findOrFail($request->input('id'));
        $this->authorizeAction($product);

        if ($product->img) {
            \Storage::delete('public/' . $product->img);
        }

        $product->delete();

        return redirect()->route('products.index')->with('success', 'محصول با موفقیت حذف شد.');
    }

    // عملیات دسته‌ای
    public function bulk_action(Request $request)
    {
        $action = $request->input('action');
        $ids = $request->input('checked_row');

        if ($action === 'delete') {
            foreach ($ids as $id) {
                $product = Product::find($id);

                if ($product) {
                    $product->images()->delete(); // حذف تمام تصاویر مرتبط با محصول
                    $product->reviews()->delete();
                    $product->delete(); // حذف محصول
                }
            }

            return redirect()->route('products.index')->with('success', 'محصولات انتخابی با موفقیت حذف شدند.');
        }

        return redirect()->route('products.index')->with('error', 'عملیات نامعتبر است.');
    }

    // نمایش اطلاعات محصول
    public function show($id)
    {
        $product = Product::with(['categories', 'tags', 'reviews.user'])->findOrFail($id);
        $this->authorizeAction($product);
        return view('products.show', compact('product'));
    }

    // ذخیره نقد و بررسی محصول
    public function storeReview(Request $request, $id)
    {
        $product = Product::findOrFail($id);
        $this->authorizeAction($product);

        $data = $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'required|string',
        ]);

        $data['user_id'] = auth()->id();
        $data['product_id'] = $product->id;

        Review::create($data);

        return redirect()->route('product', $product->id)->with('success', 'نقد و بررسی با موفقیت ثبت شد.');
    }


    public function updateAttributes(Request $request)
    {
        $product = Product::find($request->input('product_id'));
        $this->authorizeAction($product);

        if ($product) {
            // به‌روز رسانی ویژگی‌های محصول
            $product->attributes()->sync($request->input('attributes', []));

            return response()->json(['success' => true]);
        }

        return response()->json(['success' => false], 404);
    }

    public function deleteAllImages($id)
    {
        $product = Product::findOrFail($id);
        $this->authorizeAction($product);

        // حذف تمام تصاویر گالری محصول
        foreach ($product->images as $image) {
            Storage::delete('public/' . $image->url);
            $image->delete();
        }

        return redirect()->route('products.edit',$product->id)->with('success', 'تمام تصاویر محصول با موفقیت حذف شدند.');
    }
    public function deleteThumbnail($id)
    {
        $product = Product::findOrFail($id);
        $this->authorizeAction($product);

        if ($product->img) {
            \Storage::delete('public/' . $product->img);
            $product->img = null;
            $product->save();
        }

        return redirect()->route('products.edit', $product->id)->with('success', 'تصویر شاخص با موفقیت حذف شد.');
    }
    public function settings(){
        return view('products-settings');
    }


}
