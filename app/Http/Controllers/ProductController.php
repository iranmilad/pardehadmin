<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use App\Models\Review;
use App\Models\Product;
use App\Models\Category;
use App\Models\Attribute;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    // نمایش لیست محصولات
    public function index(Request $request)
    {
        $searchQuery = $request->input('s');
        $products = Product::with(['categories', 'tags'])
            ->when($searchQuery, function($query, $searchQuery) {
                return $query->where('title', 'LIKE', "%{$searchQuery}%");
            })
            ->paginate(6);

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

    // ذخیره محصول جدید
    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric',
            'sale_price' => 'nullable|numeric',
            'categories' => 'nullable|array',
            'tags' => 'nullable|array',
            'img' => 'nullable|image|max:2048',
        ]);

        if ($request->hasFile('img')) {
            $data['img'] = $request->file('img')->store('images/products', 'public');
        }

        $product = Product::create($data);

        if (isset($data['categories'])) {
            $product->categories()->sync($data['categories']);
        }

        if (isset($data['tags'])) {
            $product->tags()->sync($data['tags']);
        }

        return redirect()->route('products.list')->with('success', 'محصول با موفقیت ایجاد شد.');
    }

    // نمایش فرم ویرایش محصول
    public function edit($id)
    {
        $product = Product::with(['categories', 'tags'])->findOrFail($id);
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

    // به‌روزرسانی محصول
    public function update(Request $request, $id)
    {
        $product = Product::findOrFail($id);

        $data = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric',
            'sale_price' => 'nullable|numeric',
            'categories' => 'nullable|array',
            'tags' => 'nullable|array',
            'img' => 'nullable|image|max:2048',
            'attributes' => 'array',
            'attributes.*' => 'exists:attributes,id',
        ]);

        if ($request->hasFile('img')) {
            if ($product->img) {
                \Storage::delete('public/' . $product->img);
            }
            $data['img'] = $request->file('img')->store('images/products', 'public');
        }

        $product->update($data);

        if (isset($data['categories'])) {
            $product->categories()->sync($data['categories']);
        }

        if (isset($data['tags'])) {
            $product->tags()->sync($data['tags']);
        }

        if (isset($data['attributes'])) {
            $product->attributes()->sync($data['attributes']);
        }

        return redirect()->route('products.list')->with('success', 'محصول با موفقیت به‌روزرسانی شد.');
    }

    // حذف محصول
    public function delete(Request $request)
    {
        $product = Product::findOrFail($request->input('id'));

        if ($product->img) {
            \Storage::delete('public/' . $product->img);
        }

        $product->delete();

        return redirect()->route('products.list')->with('success', 'محصول با موفقیت حذف شد.');
    }

    // عملیات دسته‌ای
    public function bulk_action(Request $request)
    {
        $action = $request->input('action');
        $ids = $request->input('checked_row');

        if ($action === 'delete') {
            Product::whereIn('id', $ids)->delete();
            return redirect()->route('products.list')->with('success', 'محصولات انتخابی با موفقیت حذف شدند.');
        }

        return redirect()->route('products.list')->with('error', 'عملیات نامعتبر است.');
    }

    // نمایش اطلاعات محصول
    public function show($id)
    {
        $product = Product::with(['categories', 'tags', 'reviews.user'])->findOrFail($id);
        return view('products.show', compact('product'));
    }

    // ذخیره نقد و بررسی محصول
    public function storeReview(Request $request, $id)
    {
        $product = Product::findOrFail($id);

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

        if ($product) {
            // به‌روز رسانی ویژگی‌های محصول
            $product->attributes()->sync($request->input('attributes', []));

            return response()->json(['success' => true]);
        }

        return response()->json(['success' => false], 404);
    }
}
