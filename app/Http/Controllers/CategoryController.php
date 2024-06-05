<?php
namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::orderBy('created_at', 'desc')->paginate(10);;
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

        return redirect()->route('categories.list')->with('success', 'Category created successfully.');
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

        return redirect()->route('categories.list')->with('success', 'Category updated successfully.');
    }

    public function delete(Request $request)
    {
        $id = $request->input('id');
        $category = Category::findOrFail($id);
        $category->delete();
        return redirect()->route('categories.list')->with('success', 'Category deleted successfully.');
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
