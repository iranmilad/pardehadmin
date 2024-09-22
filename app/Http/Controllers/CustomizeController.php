<?php

namespace App\Http\Controllers;

use App\Models\Widget;
use App\Models\Setting;
use Illuminate\Http\Request;
use App\Traits\AuthorizeAccess;

class CustomizeController extends Controller
{
    use AuthorizeAccess;

    public function __construct()
    {
        // تنظیم نام دسترسی مورد نیاز
        $this->permissionName = 'manage_site_customizes';
    }


    public function index(Request $request)
    {
        // پیدا کردن ویجت‌های موردنظر
        $widgetNames = ['WidgetSliders', 'WidgetBanners', 'WidgetPosts', 'WidgetProducts', 'WidgetMenus', 'WidgetLanding'];

        // استخراج بلاک‌های مربوط به ویجت‌ها
        $widgets = Widget::whereIn('name', $widgetNames)->with('blocks')->get();

        // تنظیمات
        $setting = Setting::where('group', "general")->first();
        $theme = Setting::where('group', "theme")->first();
        $grid = Setting::where('group', "grid")->first();

        if (!$setting) {
            $setting = (object)[
                'settings' => [
                    'site_url' => '',
                    'site_title' => '',
                    'copyright' => '',
                    'admin_email' => '',
                    'meta_tags' => '',
                    'address_1' => '',
                    'address_2' => '',
                    'phone_1' => '',
                    'phone_2' => '',
                    'postal_code' => '',
                    'location' => '35.70222474889245,51.338657483464765',
                    'maintenance_mode' => false,
                    'maintenance_message' => 'به زودی برمیگردیم',
                    'maintenance_start' => '',
                    'maintenance_end' => '',
                ],
            ];
        }

        if (!$theme) {
            $theme = (object)[
                'settings' => [
                    'header' => 1,
                    'footer' => 1,
                ]
            ];
        }

        if (!$grid) {
            $sequence = [];

            foreach($widgets as $widget){

                foreach($widget->blocks as $block){
                    $sequence[]= $block->id;
                }

            }
            $grid = (object)[
                'settings' => [
                    'homePage' => 4, // پیش‌فرض تعداد بلاک‌ها
                    'sequence' =>  $sequence
                ]
            ];
        }

        
        


        // ارسال اطلاعات به ویو
        return view('customize', compact('setting', 'theme', 'grid', 'widgets'));
    }

    public function store(Request $request)
    {

    }


    public function update(Request $request)
    {
        // اعتبارسنجی داده‌ها
        $request->validate([
            'grid.homePage' => 'required|integer',
            'grid.sequence' => 'required|array',
            'theme.header' => 'required|integer', // اعتبارسنجی حالت هدر
            'theme.footer' => 'required|integer', // اعتبارسنجی حالت فوتر
        ]);
    
        // پیدا کردن تنظیمات grid
        $grid = Setting::where('group', 'grid')->first();
    
        if (!$grid) {
            // ایجاد تنظیمات جدید اگر وجود نداشت
            $grid = new Setting();
            $grid->group = 'grid';
        }
    
        // به‌روزرسانی تنظیمات grid
        $grid->settings = [
            'homePage' => $request->input('grid.homePage'),
            'sequence' => $request->input('grid.sequence.' . $request->input('grid.homePage')),
        ];
        $grid->section = 'main';
        // ذخیره تنظیمات در جدول
        $grid->save();
    
        // پیدا کردن تنظیمات theme
        $theme = Setting::where('group', 'theme')->first();
    
        if (!$theme) {
            // ایجاد تنظیمات جدید اگر وجود نداشت
            $theme = new Setting();
            $theme->group = 'theme';
        }
    
        // به‌روزرسانی تنظیمات theme
        $theme->settings = [
            'header' => $request->input('theme.header'),
            'footer' => $request->input('theme.footer'),
        ];
        $theme->section = 'main';
        // ذخیره تنظیمات در جدول
        $theme->save();
    
        // بازگشت به صفحه با پیام موفقیت
        return redirect()->back()->with('success', 'تنظیمات با موفقیت ذخیره شد');
    }
    
    
}
