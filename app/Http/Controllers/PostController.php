<?php
namespace App\Http\Controllers;

use App\Models\Tag;
use App\Models\Post;
use Illuminate\Support\Str;
use App\Models\PostCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::with(['user', 'categories', 'tags', 'comments'])
        ->orderBy('created_at', 'desc')
        ->paginate(10);

        return view('posts', compact('posts'));

    }

    public function edit($id)
    {
        $categories = PostCategory::all();
        $tags = Tag::all();
        $post = Post::findOrFail($id);

        return view('post', compact('post', 'categories', 'tags'));
    }

    public function create()
    {
        $categories = PostCategory::all();
        $tags = Tag::all();

        return view('post', compact('categories', 'tags'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'published' => 'required|boolean',
            'comments_enabled' => 'boolean',
            'categories' => 'required|array', // اعتبارسنجی برای فیلد categories به عنوان آرایه
            'categories.*' => 'exists:post_categories,id', // هر دسته باید معتبر باشد
            'tags' => 'sometimes|string',  // اعتبارسنجی برای فیلد tags به صورت رشته
            'thumbnail' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);

        // در صورت عدم وجود، مقدار پیش‌فرض برای comments_enabled را به false تنظیم کنید
        if (!$request->has('comments_enabled')) {
            $validated['comments_enabled'] = false;
        }

        // ایجاد اسلاگ از عنوان
        $validated['slug'] = Str::slug($validated['title']);
        $validated['user_id'] = Auth::user()->id;
        // ایجاد پست جدید
        $post = Post::create($validated);

        // مدیریت تگ‌ها
        if ($request->has('tags')) {
            $tags = json_decode($request->input('tags'), true);

            // تبدیل نام تگ‌ها به IDها و ایجاد تگ جدید در صورت عدم وجود
            $tagIds = collect($tags)->map(function ($tagName) {
                $tag = Tag::firstOrCreate(['name' => $tagName, 'description' => $tagName, 'type' => 'blog']);
                return $tag->id;
            });

            $post->tags()->sync($tagIds);
        }

        // مدیریت دسته‌بندی‌ها
        if ($request->has('categories')) {
            $post->categories()->sync($request->input('categories'));
        }

        // مدیریت فایل تصویر
        if ($request->hasFile('thumbnail')) {
            $file = $request->file('thumbnail');
            $fileName = $file->getClientOriginalName();
            $file->storeAs('public/uploads', $fileName); // ذخیره فایل در مسیر مورد نظر، مانند storage/app/uploads
            $file->move(public_path('uploads'), $fileName);
            $fileName =  str_replace('/',"\\",$fileName) ;
            $post->update(['image' => "/". 'uploads/'.$fileName]);
        }

        return redirect()->route('post.list')->with('success', 'پست با موفقیت ایجاد شد');
    }


    public function update(Request $request, $id)
    {
        $post = Post::findOrFail($id);

        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required',
            'published' => 'required|boolean',
            'comments_enabled' => 'boolean',
            'categories' => 'required|array', // اعتبارسنجی برای فیلد categories به عنوان آرایه
            'categories.*' => 'exists:post_categories,id', // هر دسته باید معتبر باشد
            'tags' => 'sometimes|string',  // اعتبارسنجی برای فیلد tags به صورت رشته
            'thumbnail' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);

        // در صورت عدم وجود، مقدار پیش‌فرض برای comments_enabled را به false تنظیم کنید
        if (!$request->has('comments_enabled')) {
            $validatedData['comments_enabled'] = false;
        }

        $post->update($validatedData);

        if ($request->has('tags')) {
            $tags = json_decode($request->input('tags'), true);

            // تبدیل نام تگ‌ها به IDها و ایجاد تگ جدید در صورت عدم وجود
            $tagIds = collect($tags)->map(function ($tagName) {
                $tag = Tag::firstOrCreate(['name' => $tagName,'description'=>$tagName,'type'=>'blog']);
                return $tag->id;
            });

            $post->tags()->sync($tagIds);
        }

        if ($request->has('categories')) {
            $post->categories()->sync($request->input('categories'));
        }

        if ($request->hasFile('thumbnail')) {

            $file = $request->file('thumbnail');
            $fileName = $file->getClientOriginalName();
            $file->storeAs('public/uploads', $fileName); // ذخیره فایل در مسیر مورد نظر، مانند storage/app/uploads
            $file->move(public_path('uploads'), $fileName);

            $post->update(['image' => "/". 'uploads/'.$fileName]);
        }

        return redirect()->route('post.list')->with('success', 'پست با موفقیت به‌روزرسانی شد');
    }


}
