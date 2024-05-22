<?php
namespace App\Http\Controllers;

use App\Models\Tag;
use App\Models\PostCategory;
use Illuminate\Http\Request;

class TagController extends Controller
{
    public function index()
    {
        $tags = Tag::orderBy('created_at', 'desc')->paginate(10);
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

        return redirect()->route('tags.list')->with('success', 'برچسب با موفقیت ایجاد شد.');
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

        return redirect()->route('tags.list')->with('success', 'برچسب با موفقیت به‌روزرسانی شد.');
    }

    public function delete(Request $request)
    {
        $tag = Tag::findOrFail($request->id);
        $tag->delete();

        return redirect()->route('tags.list')->with('success', 'برچسب با موفقیت حذف شد.');
    }

    public function bulkAction(Request $request)
    {
        $action = $request->action;
        $tagIds = $request->checked_rows;

        if ($action == 'delete' && !empty($tagIds)) {
            Tag::whereIn('id', $tagIds)->delete();
            return redirect()->route('tags.list')->with('success', 'برچسب‌ها با موفقیت حذف شدند.');
        }

        return redirect()->route('tags.list')->with('error', 'عملیات نامعتبر است.');
    }
}
