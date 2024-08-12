<?php
namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Traits\AuthorizeAccess;

class CategoryController extends Controller
{
    use AuthorizeAccess;

    public function __construct()
    {
        // تنظیم نام دسترسی مورد نیاز
        $this->permissionName = 'manage_categories';
    }

    public function index()
    {
        // ساختن کوئری برای دسته‌بندی‌ها
        $query = Category::orderBy('created_at', 'desc');

        // اعمال فیلتر بر اساس دسترسی‌های کاربر
        $query = $this->applyAccessControl($query);

        // صفحه‌بندی نتایج
        $categories = $query->paginate(10);

        return view('product-categories', compact('categories'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('product-category', compact('categories'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'alias' => 'required|string|max:255|unique:categories,alias',
            'img' => 'nullable|image',
            'description' => 'nullable|string',
            'parent_id' => 'nullable|exists:categories,id',
        ]);

        $category = Category::create($validated);

        $this->saveSubcategories($request, $category);

        return redirect()->route('categories.index')->with('success', 'Category created successfully.');
    }

    public function edit($id)
    {
        $category = Category::findOrFail($id);
        $categories = Category::all()->except($category->id);
        return view('product-category', compact('category', 'categories'));
    }

    public function update(Request $request, $id)
    {
        $category = Category::findOrFail($id);

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'alias' => 'required|string|max:255|unique:categories,alias,' . $category->id,
            'img' => 'nullable|image',
            'description' => 'nullable|string',
            'parent_id' => 'nullable|exists:categories,id',
        ]);

        $category->update($validated);

        $this->saveSubcategories($request, $category);

        return redirect()->route('categories.index')->with('success', 'Category updated successfully.');
    }

    public function delete(Request $request)
    {
        $id = $request->input('id');
        $category = Category::findOrFail($id);
        $category->delete();
        return redirect()->route('categories.index')->with('success', 'Category deleted successfully.');
    }

    private function saveSubcategories(Request $request, Category $category)
    {
        $subcategories = $request->input('subcategories', []);
        foreach ($subcategories as $index => $subcategoryData) {
            $subcategory = $category->subcategories()->updateOrCreate(
                ['id' => $subcategoryData['id'] ?? null],
                $subcategoryData
            );

            if (isset($subcategoryData['img'])) {
                $subcategory->update(['img' => $subcategoryData['img']]);
            }
        }
    }
}
