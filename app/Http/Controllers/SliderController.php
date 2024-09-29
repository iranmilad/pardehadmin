<?php

namespace App\Http\Controllers;

use App\Models\Slider;
use App\Models\Widget;
use App\Models\BlockWidget;
use App\Models\SliderImage;
use Illuminate\Http\Request;
use App\Traits\AuthorizeAccess;
use Illuminate\Support\Facades\Storage;

class SliderController extends Controller
{
    use AuthorizeAccess;

    public function __construct()
    {
        // تنظیم نام دسترسی مورد نیاز
        $this->permissionName = 'manage_sliders';
    }

    public function index(Request $request)
    {
        $query = Slider::latest();

        // اعمال فیلتر بر اساس دسترسی‌های کاربر
        $query = $this->applyAccessControl($query);

        $sliders = $query->paginate(10); // دریافت همه‌ی اسلایدرها به صورت صفحه‌بندی شده

        return view('sliders', compact('sliders'));
    }

    public function create()
    {
        $widget = Widget::where("name",'WidgetSliders')->first();
        return view('sliderAdd',compact('widget'));
    }

    public function store(Request $request)
    {
        // اعتبارسنجی داده‌های ورودی
        $validatedData = $request->validate([
            'name' => 'required|max:255',
        ]);

        $widgetId = $request->input('widget_id');
        $blockName = "Slider_" . $validatedData['name'];
        $type = $request->input('type');

        // آماده‌سازی تنظیمات به عنوان یک آرایه
        $settings = [
            'title' => '',
            'name' => $blockName,
            'link' => '',
            'type' => 'template1',
            'data' => 'selection',
            'images' => [],
        ];

        // ایجاد اسلایدر جدید
        $slider = Slider::create([
            'name' => $validatedData['name'],
        ]);

        // ذخیره ویجت با تنظیمات JSON
        BlockWidget::create([
            'widget_id' => $widgetId,
            'block' => $blockName,
            'type' => $type,
            'settings' => json_encode($settings), // تبدیل آرایه به JSON
        ]);

        // بازگشت به صفحه فهرست اسلایدرها با پیام موفقیت
        return redirect()->route('sliders.index')->with('success', 'اسلایدر با موفقیت ایجاد شد.');
    }



    public function edit($id)
    {
        $slider = Slider::findOrFail($id);

        return view('slider', compact('slider'));
    }


    public function update(Request $request, $id)
    {
        // اعتبارسنجی داده‌های ورودی
        $validatedData = $request->validate([
            'titles.*' => 'required|max:255',
            'captions.*' => 'nullable',
            'alts.*' => 'nullable',
            'links.*' => 'nullable|string|max:255',
            'files.*' => 'nullable|string|max:2048',
        ]);

        // یافتن اسلایدر
        $slider = Slider::findOrFail($id);

        // به‌روزرسانی تصاویر موجود
        foreach ($slider->images as $key => $sliderImage) {
            // به‌روزرسانی عنوان
            if (isset($validatedData['titles'][$key])) {
                $sliderImage->title = $validatedData['titles'][$key];
            }

            // به‌روزرسانی توضیحات
            if (isset($validatedData['captions'][$key])) {
                $sliderImage->caption = $validatedData['captions'][$key];
            }

            // به‌روزرسانی متن جایگزین
            if (isset($validatedData['alts'][$key])) {
                $sliderImage->alt = $validatedData['alts'][$key];
            }

            // به‌روزرسانی لینک
            if (isset($validatedData['links'][$key])) {
                $sliderImage->link = $validatedData['links'][$key];
            }

            // به‌روزرسانی تصویر (URL)
            if ($request->filled('files') && isset($validatedData['files'][$key])) {
                $sliderImage->image = $validatedData['files'][$key];
            }

            // ذخیره تغییرات
            $sliderImage->save();
        }

        // بازگشت به صفحه فهرست اسلایدرها با پیام موفقیت
        return redirect()->route('sliders.index')->with('success', 'اسلایدر با موفقیت به‌روزرسانی شد.');
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

        // یافتن اسلایدر مورد نظر
        $slider = Slider::findOrFail($id);

        // افزودن تصاویر جدید
        if ($request->filled('files')) {
            foreach ($request->input('files') as $key => $file) {
                $slider->images()->create([
                    'title' => $validatedData['titles'][$key],
                    'caption' => $validatedData['captions'][$key] ?? null,
                    'alt' => $validatedData['alts'][$key] ?? null,
                    'link' => $validatedData['links'][$key] ?? null,
                    'image' => $file ?? null, // استفاده از URL به عنوان تصویر
                ]);
            }
        }

        // بازگشت به صفحه فهرست اسلایدرها با پیام موفقیت
        return redirect()->route('sliders.index')->with('success', 'تصاویر جدید با موفقیت به اسلایدر اضافه شدند.');
    }


    public function slideView($id)
    {
        $slider = Slider::findOrFail($id);
        return view('sliderCreate',compact("slider"));
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

        $slider = Slider::findOrFail($id);

        if ($request->filled('file')) {
            $imagePath = $request->input('file');
        }
        $slider->images()->create([
            'title' => $validatedData['title'],
            'caption' => $validatedData['caption'],
            'alt' => $validatedData['alt'],
            'link' => $validatedData['link'],
            'image' => $imagePath,
        ]);

        return redirect()->route('sliders.index')->with('success', 'تصویر جدید به اسلایدر افزوده شد.');
    }

    public function deleteImage($image_id)
    {
        $sliderImage = SliderImage::findOrFail($image_id);

        $sliderImage->delete();

        return redirect()->back()->with('success', 'تصویر با موفقیت حذف شد.');
    }

    public function delete($id)
    {
        $slider = Slider::findOrFail($id);
        $this->authorizeAction($slider);
        $block = BlockWidget::where("block","Slider_".$slider->name);
        $slider->delete();
        $block->delete();

        return redirect()->route('sliders.index')->with('success', 'اسلایدر با موفقیت حذف شد.');
    }
    public function bulk_action(Request $request)
    {
        // اعتبارسنجی داده‌های ورودی
        $validatedData = $request->validate([
            'action' => 'required|in:delete',
            'slider_ids' => 'required|array', // شناسه‌های اسلایدر باید به صورت آرایه ارسال شوند
        ]);

        $slider_ids = $request->input('slider_ids');

        // بررسی اکشن و اجرای عملیات
        switch ($validatedData['action']) {
            case 'delete':
                // حذف اسلایدرها به همراه ویجت‌های مرتبط
                foreach ($slider_ids as $slider_id) {
                    $slider = Slider::findOrFail($slider_id);
                    $this->authorizeAction($slider); // بررسی دسترسی کاربر

                    // حذف اسلایدر و ویجت‌های مرتبط
                    $block = BlockWidget::where("block", "Slider_" . $slider->name);
                    $slider->delete();
                    $block->delete();
                }
                $message = 'اسلایدرها با موفقیت حذف شدند!';
                break;
        }

        // بازگشت به صفحه فهرست اسلایدرها با پیام موفقیت
        return redirect()->route('sliders.index')->with('success', $message);
    }


}
