<?php


namespace App\Http\Controllers;

use App\Models\Tag;
use Illuminate\Http\Request;
use App\Traits\AuthorizeAccess;

class ProductTagController extends Controller
{
    use AuthorizeAccess;

    public function __construct()
    {
        // تنظیم نام دسترسی مورد نیاز
        $this->permissionName = 'manage_product_tags';
    }

    public function index(Request $request)
    {
        // ساختن کوئری برای Tag
        $query = Tag::query();

        // اعمال فیلتر بر اساس دسترسی‌های کاربر
        $query = $this->applyAccessControl($query);

        // صفحه‌بندی نتایج
        $tags = $query->paginate(10);

        return view('product-tags', compact('tags'));
    }

    public function create()
    {
        return view('product-tag');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'slug' => 'required|unique:tags,slug',
            'type' => 'required',
        ]);

        Tag::create($request->all());

        return redirect()->route('products.tags.index')->with('success', 'برچسب با موفقیت ایجاد شد');
    }

    public function edit($id)
    {
        $tag = Tag::findOrFail($id);
        return view('product-tag', compact('tag'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'slug' => 'required|unique:tags,slug,' . $id,
            'type' => 'required',
        ]);

        $tag = Tag::findOrFail($id);
        $tag->update($request->all());

        return redirect()->route('products.tags.index')->with('success', 'برچسب با موفقیت ویرایش شد');
    }

    public function delete(Request $request)
    {
        $tag = Tag::findOrFail($request->id);
        $tag->delete();

        return redirect()->route('products.tags.index')->with('success', 'برچسب با موفقیت حذف شد');
    }
}
