<?php

namespace App\Http\Controllers;

use App\Models\Page;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Traits\AuthorizeAccess;
use Illuminate\Validation\Rule;

class PageController extends Controller
{
    use AuthorizeAccess;

    public function __construct()
    {
        // تنظیم نام دسترسی مورد نیاز
        $this->permissionName = 'manage_pages';
    }

    public function index(Request $request)
    {
        // ساختن کوئری برای Page
        $query = Page::with('user');

        // اعمال فیلتر بر اساس دسترسی‌های کاربر
        $query = $this->applyAccessControl($query);
        $search = $request->input('s');
        if ($search) {
            $query->where('title', 'LIKE', "%{$search}%");
        };
        // صفحه‌بندی نتایج
        $pages = $query->orderBy("created_at","desc")->paginate(10);

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

            'status' => 'required|in:published,inactive',
            'comments_enabled' => 'boolean'
        ]);

        $validatedData['user_id'] = auth()->id(); // تنظیم شناسه کاربر برای صفحه جدید
        $validatedData['slug'] = Str::slug($validatedData['title']);
        $validatedData['url'] = "/".Str::slug($validatedData['title']);
        Page::create($validatedData);

        return redirect()->route('pages.index')->with('success', 'صفحه با موفقیت ایجاد شد');
    }

    public function edit($id)
    {
        $page = Page::findOrFail($id);
        $this->authorizeAction($page);
        return view('page', compact('page'));
    }

    public function update(Request $request, $id)
    {
        // پیدا کردن صفحه و بررسی دسترسی
        $page = Page::findOrFail($id);
        $this->authorizeAction($page);

        // اعتبارسنجی داده‌ها
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'slug' => [
                'required',
                Rule::unique('pages', 'slug')->ignore($id), // جلوگیری از تکراری بودن در صورت عدم تغییر
            ],
            'content' => 'required|string',
            'summary' => 'nullable|string|max:255',
            'keywords' => 'nullable|string|max:255',
            'status' => 'required|in:published,inactive',
        ]);

        // تولید slug و URL به شکل امن و استاندارد

        $validatedData['url'] = "/" . $validatedData['slug'];

        // به‌روزرسانی صفحه
        $page->update($validatedData);

        // بازگشت به صفحه فهرست صفحات با پیام موفقیت
        return redirect()->route('pages.index')->with('success', 'صفحه با موفقیت به‌روزرسانی شد');
    }

    public function delete($id)
    {
        $page = Page::find($id);
        $this->authorizeAction($page);
        $page->delete();
        return redirect()->route('pages.index')->with('success', 'صفحه با موفقیت حذف شد');
    }

    public function bulk_action(Request $request)
    {
        // اجرای عملیات گروهی روی صفحات
        if ($request->action == 'delete') {
            Page::whereIn('id', $request->checked_rows)->delete();
            return redirect()->route('pages.index')->with('success', 'صفحات با موفقیت حذف شدند');
        }
    }
}
