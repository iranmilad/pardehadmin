<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Page;

class PageController extends Controller
{
    public function index()
    {
        $pages = Page::with('user')->orderBy('created_at', 'desc')->paginate(10);
        return view('pages', compact('pages'));
    }


    public function create()
    {
        return view('page');
    }


    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'summary' => 'nullable|string|max:255',
            'keywords' => 'nullable|string|max:255',
            'url' => 'nullable|string|max:255|unique:pages,url',
            'status' => 'required|in:published,inactive',
            'comments_enabled' => 'boolean'
        ]);

        $validatedData['user_id'] = auth()->id(); // تنظیم شناسه کاربر برای صفحه جدید

        Page::create($validatedData);

        return redirect()->route('pages.list')->with('success', 'صفحه با موفقیت ایجاد شد');
    }

    public function edit($id)
    {
        $page = Page::findOrFail($id);
        return view('page', compact('page'));
    }

    public function update(Request $request, $id)
    {
        //dd($request);
        $page = Page::findOrFail($id);

        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'summary' => 'nullable|string|max:255',
            'keywords' => 'nullable|string|max:255',
            'url' => 'nullable|string|max:255|unique:pages,url,' . $page->id,
            'status' => 'required|in:published,inactive',
        ]);

        $page->update($validatedData);

        return redirect()->route('pages.list')->with('success', 'صفحه با موفقیت به‌روزرسانی شد');
    }

    public function delete(Request $request)
    {
        $page = Page::find($request->id);
        $page->delete();
        return redirect()->route('pages.list')->with('success', 'صفحه با موفقیت حذف شد');
    }

    public function bulk_action(Request $request)
    {
        // اجرای عملیات گروهی روی صفحات
        if ($request->action == 'delete') {
            Page::whereIn('id', $request->checked_rows)->delete();
            return redirect()->route('pages.list')->with('success', 'صفحات با موفقیت حذف شدند');
        }
    }
}
