<?php

namespace App\Http\Controllers;

use App\Models\Banner;
use App\Models\Widget;
use App\Models\BlockWidget;
use App\Models\BannerImage;
use Illuminate\Http\Request;
use App\Traits\AuthorizeAccess;
use Illuminate\Support\Facades\Storage;

class BannerController extends Controller
{
    use AuthorizeAccess;

    public function __construct()
    {
        // تنظیم نام دسترسی مورد نیاز
        $this->permissionName = 'manage_banners';
    }

    public function index(Request $request)
    {
        $query = Banner::latest();

        // اعمال فیلتر بر اساس دسترسی‌های کاربر
        $query = $this->applyAccessControl($query);

        $banners = $query->paginate(10); // دریافت همه‌ی بنر به صورت صفحه‌بندی شده

        return view('banners.index', compact('banners'));
    }

    public function create()
    {
        $widget = Widget::where('name', 'WidgetBanners')->first();

        // استخراج JSON از ستون setup و decode کردن آن
        $setup = json_decode($widget->setup, true);

        // استخراج type از setup
        $types = [];
        if (isset($setup['selection']['i']['type'])) {
            $template = str_replace("o|",'',$setup['selection']['i']['type']);
            $types = explode(':', $template); // جدا کردن مقادیر type
        }

        return view('banners.create', compact('widget', 'types'));
    }


    public function store(Request $request)
    {
        // اعتبارسنجی داده‌های ورودی
        $validatedData = $request->validate([
            'name' => 'required|max:255',
        ]);

        $widgetId = $request->input('widget_id');
        $blockName = "Banner_" . $validatedData['name'];
        $type = $request->input('type'); // دریافت نوع ارسال شده از فرم

        // آماده‌سازی تنظیمات به عنوان یک آرایه
        $settings = [
            'title' => '',
            'name' => $validatedData['name'],
            'link' => '',
            'type' => $type, // استفاده از مقدار type ورودی به جای مقدار ثابت
            'data' => 'selection',
            'images' => [],
        ];

        // ایجاد بنر جدید
        $banner = Banner::create([
            'name' => $validatedData['name'],
        ]);

        // ذخیره ویجت با تنظیمات JSON
        BlockWidget::create([
            'widget_id' => $widgetId,
            'block' => $blockName,
            'type' => "selection",
            'settings' => json_encode($settings), // تبدیل آرایه به JSON
        ]);

        // بازگشت به صفحه فهرست بنر با پیام موفقیت
        return redirect()->route('banners.index')->with('success', 'بنر با موفقیت ایجاد شد.');
    }





    public function edit($id)
    {
        $banner = Banner::findOrFail($id);

        return view('banners.edit', compact('banner'));
    }


    public function update(Request $request, $id)
    {
        // اعتبارسنجی داده‌های ورودی
        $validatedData = $request->validate([
            'titles.*' => 'required|max:255',
            'captions.*' => 'nullable',
            'alts.*' => 'nullable',
            'links.*' => 'nullable|url|max:255',
            'files.*' => 'nullable|url|max:2048',
        ]);

        // یافتن بنر
        $banner = Banner::findOrFail($id);

        // به‌روزرسانی تصاویر موجود
        foreach ($banner->images as $key => $bannerImage) {
            // به‌روزرسانی عنوان
            if (isset($validatedData['titles'][$key])) {
                $bannerImage->title = $validatedData['titles'][$key];
            }

            // به‌روزرسانی توضیحات
            if (isset($validatedData['captions'][$key])) {
                $bannerImage->caption = $validatedData['captions'][$key];
            }

            // به‌روزرسانی متن جایگزین
            if (isset($validatedData['alts'][$key])) {
                $bannerImage->alt = $validatedData['alts'][$key];
            }

            // به‌روزرسانی لینک
            if (isset($validatedData['links'][$key])) {
                $bannerImage->link = $validatedData['links'][$key];
            }

            // به‌روزرسانی تصویر (URL)
            if ($request->filled('files') && isset($validatedData['files'][$key])) {
                $bannerImage->image = $validatedData['files'][$key];
            }

            // ذخیره تغییرات
            $bannerImage->save();
        }

        // بازگشت به صفحه فهرست بنر با پیام موفقیت
        return redirect()->route('banners.index')->with('success', 'بنر با موفقیت به‌روزرسانی شد.');
    }


    public function addImage(Request $request, $id)
    {
        // اعتبارسنجی داده‌های ورودی
        $validatedData = $request->validate([
            'titles.*' => 'required|max:255',
            'captions.*' => 'nullable',
            'alts.*' => 'nullable',
            'links.*' => 'nullable|url|max:255', // اضافه کردن اعتبارسنجی لینک‌ها
            'files.*' => 'nullable|url|max:2048', // اعتبارسنجی URL فایل‌ها
        ]);

        // یافتن بنر مورد نظر
        $banner = Banner::findOrFail($id);

        // افزودن تصاویر جدید
        if ($request->filled('files')) {
            foreach ($request->input('files') as $key => $file) {
                $banner->images()->create([
                    'title' => $validatedData['titles'][$key],
                    'caption' => $validatedData['captions'][$key] ?? null,
                    'alt' => $validatedData['alts'][$key] ?? null,
                    'link' => $validatedData['links'][$key] ?? null,
                    'image' => $file ?? null, // استفاده از URL به عنوان تصویر
                ]);
            }
        }

        // بازگشت به صفحه فهرست بنر با پیام موفقیت
        return redirect()->route('banners.index')->with('success', 'تصاویر جدید با موفقیت به بنر اضافه شدند.');
    }


    public function slideView($id)
    {
        $banner = Banner::findOrFail($id);
        return view('banners.add',compact("banner"));
    }

    public function storeNewImage(Request $request, $id)
    {
        $validatedData = $request->validate([
            'title' => 'required|max:255',
            'caption' => 'nullable',
            'alt' => 'nullable',
            'link' => 'nullable|url|max:255',
            'file' => 'required|url|max:2048',
        ]);

        $banner = Banner::findOrFail($id);

        if ($request->filled('file')) {
            $imagePath = $request->input('file');
        }
        $banner->images()->create([
            'title' => $validatedData['title'],
            'caption' => $validatedData['caption'],
            'alt' => $validatedData['alt'],
            'link' => $validatedData['link'],
            'image' => $imagePath,
        ]);

        return redirect()->route('banners.index')->with('success', 'تصویر جدید به بنر افزوده شد.');
    }

    public function deleteImage($image_id)
    {
        $bannerImage = BannerImage::findOrFail($image_id);

        $bannerImage->delete();

        return redirect()->back()->with('success', 'تصویر با موفقیت حذف شد.');
    }

    public function delete($id)
    {
        $banner = Banner::findOrFail($id);
        $this->authorizeAction($banner);
        $block = BlockWidget::where("block","Banner_".$banner->name);
        $banner->delete();
        $block->delete();

        return redirect()->route('banners.index')->with('success', 'بنر با موفقیت حذف شد.');
    }
    public function bulk_action(Request $request)
    {
        // اعتبارسنجی داده‌های ورودی
        $validatedData = $request->validate([
            'action' => 'required|in:delete',
            'banner_ids' => 'required|array', // شناسه‌های بنر باید به صورت آرایه ارسال شوند
        ]);

        $banner_ids = $request->input('banner_ids');

        // بررسی اکشن و اجرای عملیات
        switch ($validatedData['action']) {
            case 'delete':
                // حذف بنر به همراه ویجت‌های مرتبط
                foreach ($banner_ids as $banner_id) {
                    $banner = Banner::findOrFail($banner_id);
                    $this->authorizeAction($banner); // بررسی دسترسی کاربر

                    // حذف بنر و ویجت‌های مرتبط
                    $block = BlockWidget::where("block", "Banner_" . $banner->name);
                    $banner->delete();
                    $block->delete();
                }
                $message = 'بنر با موفقیت حذف شدند!';
                break;
        }

        // بازگشت به صفحه فهرست بنر با پیام موفقیت
        return redirect()->route('banners.index')->with('success', $message);
    }


}
