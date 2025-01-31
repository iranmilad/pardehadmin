<?php

namespace App\Http\Controllers;

use App\Models\Widget;
use App\Models\Landing;
use App\Models\BlockWidget;
use Illuminate\Http\Request;
use App\Traits\AuthorizeAccess;

class LandingController extends Controller
{
    use AuthorizeAccess;

    public function __construct()
    {
        // تنظیم نام دسترسی مورد نیاز
        $this->permissionName = 'manage_landings';
    }

    public function index(Request $request)
    {
        $widget = Widget::where('name', 'WidgetLanding')->first();
        $query = BlockWidget::where('widget_id', $widget->id)->latest();
        $query = $this->applyAccessControl($query);
        $landings = $query->paginate(10); // می‌توانید تعداد آیتم‌ها در هر صفحه را تغییر دهید

        return view('landings.index', compact('landings'));
    }


    public function create()
    {
        // {"title":"20% تخفیف بهار تابستان","name":"Landing 1","link":"","description":"با کد تخفیف بیشتر در فروش زمستانی ما صرفه جویی کنید  + ارسال رایگان برای تمام سفارشات بالای 50 تومان","btnLink1":"/link1","cap1":"اکنون کشف کنید!","btnLink2":"","cap2":"","style":"template1","type":"image","image":"/images/content/fc-img1.jpg","video":"/"}


        // {
        //     "image":{"i":{"title":"t|","name":"t|","description":"t|","link":"t|","btnLink1":"t|","btnLink2":"t|","cap1":"t|","cap2":"t|","image":"t|","video":"t|","type":"f|image","style":"o|template1"},"l":"صفحه فرود"}
        // }

        $widget = Widget::where('name', 'WidgetLanding')->first();

        // استخراج JSON از ستون setup و decode کردن آن
        $setup = json_decode($widget->setup, true);

        // استخراج type از setup
        $styles = [];
        if (isset($setup['image']['i']['style'])) {
            $template = str_replace("o|",'',$setup['image']['i']['style']);
            $styles = explode(':', $template); // جدا کردن مقادیر type
        }

        return view('landings.create', compact('widget', 'styles'));
    }

    public function store(Request $request)
    {
        // {"title":"20% تخفیف بهار تابستان","name":"Landing 1","link":"","description":"با کد تخفیف بیشتر در فروش زمستانی ما صرفه جویی کنید  + ارسال رایگان برای تمام سفارشات بالای 50 تومان","btnLink1":"/link1","cap1":"اکنون کشف کنید!","btnLink2":"","cap2":"","style":"template1","type":"image","image":"/images/content/fc-img1.jpg","video":"/"}
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'name' => 'nullable|string|max:255',
            'direction' => 'required|in:rtl,ltr',
            'link' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'btnLink1' => 'nullable|string',
            'cap1' => 'nullable|string',
            'btnLink2' => 'nullable|string',
            'cap2' => 'nullable|string',
            'style' => 'required|string',
            'type' => 'nullable|string',
            'image' => 'nullable|string',
            'video' => 'nullable|string',
            'file' => 'nullable|max:2048', // اعتبارسنجی برای تصویر
        ]);
        // ذخیره تصویر اگر موجود باشد
        if ($request->filled('file')) {
            $data['image'] =  $request->input('file');
        }

        $widgetId = $request->input('widget_id');
        $blockName = "لندینگ " . $data['name'];
        $style = $request->input('style'); // دریافت نوع ارسال شده از فرم

        // آماده‌سازی تنظیمات به عنوان یک آرایه
        $settings = [
            'title' => $data['title'],
            'name' => $blockName,
            'link' => $data['link'],
            'description' => $data['description'],
            'btnLink1' => $data['btnLink1'],
            'cap1' => $data['cap1'],
            'btnLink2' => $data['btnLink2'],
            'cap2' => $data['cap2'],
            'direction'=> $data['direction'],
            'style' => $style, // استفاده از مقدار type ورودی به جای مقدار ثابت
            'type' =>'image',
            'image' => $data['image'],

        ];


        // ذخیره ویجت با تنظیمات JSON
        BlockWidget::create([
            'widget_id' => $widgetId,
            'block' => $blockName,
            'type' => 'image',
            'settings' => $settings, // تبدیل آرایه به JSON
        ]);

        return redirect()->route('landings.index')->with('success', 'لندینگ جدید ایجاد شد.');
    }

    public function edit($id)
    {
        $landing = BlockWidget::findOrFail($id);
        $widget = Widget::where('name', 'WidgetLanding')->first();

        //$landing = json_decode($block->settings, true);

        // استخراج JSON از ستون setup و decode کردن آن
        $setup = json_decode($widget->setup, true);

        // استخراج type از setup
        $styles = [];
        if (isset($setup['image']['i']['style'])) {
            $template = str_replace("o|",'',$setup['image']['i']['style']);
            $styles = explode(':', $template); // جدا کردن مقادیر type
        }
        return view('landings.edit', compact('landing', 'styles'));
    }

    public function update(Request $request, $id)
    {
        // پیدا کردن لندینگ با استفاده از شناسه
        $landing = BlockWidget::findOrFail($id);

        // اعتبارسنجی ورودی‌ها
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'block' => 'nullable|string|max:255',
            'direction' => 'required|in:rtl,ltr',
            'link' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'btnLink1' => 'nullable|string',
            'cap1' => 'nullable|string',
            'btnLink2' => 'nullable|string',
            'cap2' => 'nullable|string',
            'style' => 'required|string',
            'type' => 'nullable|string',
            'image' => 'nullable|string',
            'video' => 'nullable|string',
            'file' => 'nullable|max:2048', // اعتبارسنجی برای تصویر
        ]);

        // به‌روزرسانی تصویر اگر موجود باشد
        if ($request->filled('file')) {
            $data['image'] = $request->input('file');
        }
        else{
            $data['image'] = $landing->settings->image ?? null;
        }

        $blockName =$data['block'] ?? "لندینگ " . ($data['title'] ?? $landing->title);
        $style = $data['style'];

        // تنظیمات برای ذخیره در ویجت
        $settings = [
            'title' => $data['title'],
            'name' => $blockName,
            'link' => $data['link'] ?? null,
            'description' => $data['description'] ?? null,
            'btnLink1' => $data['btnLink1'] ?? null,
            'cap1' => $data['cap1'] ?? null,
            'btnLink2' => $data['btnLink2'] ?? null,
            'cap2' => $data['cap2'] ?? null,
            'direction' => $data['direction'],
            'style' => $style,
            'type' => 'image',
            'image' => $data['image'],
        ];

        // به‌روزرسانی ویجت
        $landing->update([
            'block' => $blockName,
            'type' => 'image',
            'settings' => $settings,
        ]);

        // بازگرداندن به صفحه فهرست لندینگ‌ها با پیام موفقیت
        return redirect()->route('landings.index')->with('success', 'لندینگ به‌روزرسانی شد.');
    }



    public function delete(Request $request)
    {
        $landing = Landing::findOrFail($request->id);
        $landing->delete();
        return redirect()->route('landings.index')->with('success', 'لندینگ حذف شد.');
    }

    public function bulk_action(Request $request)
    {
        $ids = $request->input('selected_ids', []);
        Landing::whereIn('id', $ids)->delete();
        return redirect()->route('landings.index')->with('success', 'عملیات گروهی با موفقیت انجام شد.');
    }
}
