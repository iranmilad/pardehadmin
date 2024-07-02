<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use App\Models\Review;
use App\Models\Product;
use App\Models\Category;
use App\Models\Attribute;
use App\Models\ProductImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

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


    public function store(Request $request)
    {
        // Validate incoming request data
        $data = $request->validate([
            'title' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'price' => 'nullable|numeric',
            'sale_price' => 'nullable|numeric',
            'img' => 'nullable|image|max:2048',
            'gallery.*' => 'nullable|image|max:2048',
            'categories' => 'nullable|array', // Ensure categories is an array
            'tags' => 'nullable|string', // Tags will be handled separately
        ]);
    
        // Handle categories synchronization
        if ($request->has('categories')) {
            $categories = $request->input('categories');
        }
    
        // Handle tags synchronization
        if ($request->has('tags')) {
            $tags = json_decode($request->input('tags'), true);
        }
    
        // Handle main product image upload
        if ($request->hasFile('img')) {
            $file = $request->file('img');
            $address = 'uploads/images/products';
            $fileName = $file->getClientOriginalName();
            $file->storeAs('public/uploads/images/products', $fileName); // ذخیره فایل در مسیر مورد نظر، مانند storage/app/uploads
            $file->move(public_path($address), $fileName);
            $imgPath =  $address.'/'.$fileName ;
 
            $data['img'] = $imgPath;
        }
    
        // Create product instance
        $product = Product::create($data);
    
        // Handle gallery images upload and association
        if ($request->hasFile('gallery')) {
            foreach ($request->file('gallery') as $file) {
                $address = 'uploads/images/products/'.$product->id.'/gallery';
                $fileName = $file->getClientOriginalName();
                $file->storeAs('public/uploads/images/products/'.$product->id.'/gallery', $fileName); // ذخیره فایل در مسیر مورد نظر، مانند storage/app/uploads
                $file->move(public_path($address), $fileName);
                $galleryPath =  $address.'/'.$fileName ;

                // ایجاد تصویر جدید برای محصول
                $image = new ProductImage(['url' => "/".$galleryPath]);
                $product->images()->save($image);
            }
        }
    
        // Synchronize categories if provided
        if (isset($categories)) {
            $product->categories()->sync($categories);
        }
    
        // Synchronize tags if provided
        if (isset($tags)) {
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
        $product = Product::findOrFail($id);

        // Validate input data
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'nullable|numeric',
            'sale_price' => 'nullable|numeric',
            'service' => 'nullable|boolean',
            'img' => 'nullable|image|max:2048', // img validation
            'gallery.*' => 'nullable|image|max:2048', // Gallery validation
            'video' => 'nullable|mimes:mp4|max:20480', // Video validation
        ]);

        //$product->service = $request->input('service');
        
        // مدیریت دسته‌بندی‌ها
        if ($request->has('categories')) {
            $product->categories()->sync($request->input('categories'));
        }

        if ($request->has('tags')) {
            $tags = json_decode($request->input('tags'), true);

            // تبدیل نام تگ‌ها به IDها و ایجاد تگ جدید در صورت عدم وجود
            $tagIds = collect($tags)->map(function ($tagName) {
                $tag = Tag::firstOrCreate(['name' => $tagName["value"], 'description' => $tagName["value"], 'type' => 'ability']);
                return $tag->id;
            });

            $product->tags()->sync($tagIds);
        }

        // Handle img image update
        if ($request->hasFile('img')) {
            $file = $request->file('img');
            $address = 'uploads/images/products/'.$product->id;
            $fileName = $file->getClientOriginalName();
            $file->storeAs('public/uploads/images/products/'.$product->id, $fileName); // ذخیره فایل در مسیر مورد نظر، مانند storage/app/uploads
            $file->move(public_path($address), $fileName);
            $imgPath =  $address.'/'.$fileName ;
            $data['img'] = $imgPath;

            // Delete old img if exists
            if ($product->img) {
                \Storage::delete('public/' . $product->img);
            }
        }

        // Update product details
        $product->update($data);

        // Handle gallery images update
        if ($request->hasFile('gallery')) {
            foreach ($request->file('gallery') as $file) {

                $address = 'uploads/images/products/'.$product->id.'/gallery';
                $fileName = $file->getClientOriginalName();
                $file->storeAs('public/uploads/images/products/'.$product->id.'/gallery', $fileName); // ذخیره فایل در مسیر مورد نظر، مانند storage/app/uploads
                $file->move(public_path($address), $fileName);
                $galleryPath =  $address.'/'.$fileName ;

                // ایجاد تصویر جدید برای محصول
                $image = new ProductImage(['url' => "/".$galleryPath]);
                $product->images()->save($image);
            }
        }

        // Handle video update
        if ($request->hasFile('video')) {
            $file = $request->file('video');
            $address = 'uploads/videos/products/'.$product->id.'/gallery';
            $fileName = $file->getClientOriginalName();
            $file->storeAs('public/uploads/videos/products/'.$product->id, $fileName); // ذخیره فایل در مسیر مورد نظر، مانند storage/app/uploads
            $file->move(public_path($address), $fileName);
            $video =  $address.'/'.$fileName ;

            $data['video_path'] = $video;

            // Delete old video if exists
            if ($product->video_path) {
                \Storage::delete('public/' . $product->video_path);
            }
        }

        // Update product with new video path if provided
        if (isset($data['video_path'])) {
            $product->update(['video_path' => $data['video_path']]);
        }

        return redirect()->route('products.edit',$product->id)->with('success', 'محصول با موفقیت به‌روزرسانی شد.');
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

    public function deleteAllImages($id)
    {
        $product = Product::findOrFail($id);

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
