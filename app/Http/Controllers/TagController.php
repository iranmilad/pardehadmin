<?php
namespace App\Http\Controllers;

use App\Models\Tag;
use App\Models\PostCategory;
use Illuminate\Http\Request;
use App\Traits\AuthorizeAccess;

class TagController extends Controller
{
    use AuthorizeAccess;

    public function __construct()
    {
        // تنظیم نام دسترسی مورد نیاز
        $this->permissionName = 'manage_tags';
    }

    public function index(Request $request)
    {
        $query = Tag::orderBy('created_at', 'desc');

        // اعمال فیلتر بر اساس دسترسی‌های کاربر
        $query = $this->applyAccessControl($query);

        $tags = $query->paginate(10);

        return view('post-tags', compact('tags'));
    }

    public function create()
    {
        return view('post-tag');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:tags,name',
            'slug' => 'required|string|max:255|unique:tags,slug',
        ]);

        Tag::create($request->all());

        return redirect()->route('tags.index')->with('success', 'برچسب با موفقیت ایجاد شد.');
    }

    public function edit($id)
    {
        $tag = Tag::findOrFail($id);
        return view('post-tag', compact('tag'));
    }

    public function update(Request $request, $id)
    {
        $tag = Tag::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255|unique:tags,name,' . $tag->id,
            'slug' => 'required|string|max:255|unique:tags,slug,' . $tag->id,
        ]);

        $tag->update($request->all());

        return redirect()->route('tags.index')->with('success', 'برچسب با موفقیت به‌روزرسانی شد.');
    }

    public function delete(Request $request)
    {
        $tag = Tag::findOrFail($request->id);
        $tag->delete();

        return redirect()->route('tags.index')->with('success', 'برچسب با موفقیت حذف شد.');
    }

    public function bulkAction(Request $request)
    {
        $action = $request->action;
        $tagIds = $request->checked_rows;

        if ($action == 'delete' && !empty($tagIds)) {
            Tag::whereIn('id', $tagIds)->delete();
            return redirect()->route('tags.index')->with('success', 'برچسب‌ها با موفقیت حذف شدند.');
        }

        return redirect()->route('tags.index')->with('error', 'عملیات نامعتبر است.');
    }
}
