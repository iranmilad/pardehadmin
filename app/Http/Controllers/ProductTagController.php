<?php


namespace App\Http\Controllers;

use App\Models\Tag;
use Illuminate\Http\Request;

class ProductTagController extends Controller
{
    public function index(Request $request)
    {
        $tags = Tag::paginate(10);
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

        return redirect()->route('products.tags.list')->with('success', 'برچسب با موفقیت ایجاد شد');
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

        return redirect()->route('products.tags.list')->with('success', 'برچسب با موفقیت ویرایش شد');
    }

    public function delete(Request $request)
    {
        $tag = Tag::findOrFail($request->id);
        $tag->delete();

        return redirect()->route('products.tags.list')->with('success', 'برچسب با موفقیت حذف شد');
    }
}
