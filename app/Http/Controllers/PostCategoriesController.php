<?php
namespace App\Http\Controllers;

use App\Models\PostCategory;
use Illuminate\Http\Request;
use App\Traits\AuthorizeAccess;

class PostCategoriesController extends Controller
{
    use AuthorizeAccess;

    public function __construct()
    {
        // تنظیم نام دسترسی مورد نیاز
        $this->permissionName = 'manage_post_categories';
    }

    public function index()
    {
        // ساختن کوئری برای PostCategory
        $query = PostCategory::withCount('posts')->orderBy('created_at', 'desc');

        // اعمال فیلتر بر اساس دسترسی‌های کاربر
        $query = $this->applyAccessControl($query);

        // صفحه‌بندی نتایج
        $categories = $query->paginate(10);

        return view('post-categories', compact('categories'));
    }
    public function create()
    {
        return view('post-category');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:post_categories,slug',
            'children.*.name' => 'nullable|string|max:255',
            'children.*.slug' => 'nullable|string|max:255|unique:post_categories,slug',
        ]);

        $category = PostCategory::create([
            'name' => $request->name,
            'slug' => $request->slug,
        ]);

        if ($request->has('children')) {
            foreach ($request->children as $child) {
                $category->children()->create([
                    'name' => $child['name'],
                    'slug' => $child['slug'],
                ]);
            }
        }

        return redirect()->route('postCategories.index')->with('success', 'دسته‌بندی با موفقیت ایجاد شد.');
    }

    public function edit($id)
    {
        $category = PostCategory::with('children')->findOrFail($id);
        return view('post-category', compact('category'));
    }

    public function update(Request $request, $id)
    {
        $category = PostCategory::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:post_categories,slug,' . $category->id,
            'children.*.name' => 'nullable|string|max:255',
            'children.*.slug' => 'nullable|string|max:255|unique:post_categories,slug,' . $category->id,
        ]);

        $category->update([
            'name' => $request->name,
            'slug' => $request->slug,
        ]);

        $category->children()->delete();
        if ($request->has('children')) {
            foreach ($request->children as $child) {
                $category->children()->create([
                    'name' => $child['name'],
                    'slug' => $child['slug'],
                ]);
            }
        }

        return redirect()->route('postCategories.index')->with('success', 'دسته‌بندی با موفقیت به‌روزرسانی شد.');
    }

    public function delete(Request $request)
    {
        $category = PostCategory::findOrFail($request->id);
        $category->delete();

        return redirect()->route('postCategories.index')->with('success', 'دسته‌بندی با موفقیت حذف شد.');
    }
}
