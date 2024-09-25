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
        $style = Setting::where('group', "style")->first();

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

        if (!$style) {
            $style = (object)[
                'settings' => [
                    'font' => 'IranYekan', // فونت پیشفرض
                    'primary' => '#2f415d', // رنگ اصلی
                    'bg-background' => '#fff', // رنگ پس‌زمینه
                    'header-bg' => '#f8f8fa', // رنگ پس‌زمینه هدر
                    'header-color' => '#000', // رنگ عناوین
                    'footer-bg' => '#020202', // رنگ فوتر
                 
                ]
            ];
        }
               
        


        // ارسال اطلاعات به ویو
        return view('customize', compact('setting', 'theme', 'grid', 'widgets','style'));
    }

    public function store(Request $request)
    {

    }


    public function update(Request $request)
    {
        //dd($request);
        // اعتبارسنجی داده‌ها
        $request->validate([
            'grid.homePage' => 'required|integer',
            'grid.sequence' => 'required|array',
            'theme.header' => 'required|integer', // اعتبارسنجی حالت هدر
            'theme.footer' => 'required|integer', // اعتبارسنجی حالت فوتر
            'style.font' => 'required|string', // اعتبارسنجی انتخاب فونت
            'style.primary' => 'required|string',
            'style.bg-background' => 'required|string',
            'style.header-bg' => 'required|string',
            'style.header-color' => 'required|string',
            'style.footer-bg' => 'required|string',
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
        
        // پیدا کردن تنظیمات style
        $style = Setting::where('group', 'style')->first();
        
        if (!$style) {
            // ایجاد تنظیمات جدید اگر وجود نداشت
            $style = new Setting();
            $style->group = 'style';
        }
        
        // به‌روزرسانی تنظیمات style (فونت و رنگ‌ها)
        $style->settings = [
            'font' => $request->input('style.font'), // ذخیره فونت انتخاب شده
            'primary' => $request->input('style.primary'),
            'bg-background' => $request->input('style.bg-background'),
            'header-bg' => $request->input('style.header-bg'),
            'header-color' => $request->input('style.header-color'),
            'footer-bg' => $request->input('style.footer-bg'),
        ];
        $style->section = 'main';
        // ذخیره تنظیمات در جدول
        $style->save();
        
        // بازگشت به صفحه با پیام موفقیت
        return redirect()->back()->with('success', 'تنظیمات با موفقیت ذخیره شد');
    }
    
    public function reset(){
        $setting = Setting::where("group","grid")->first();
        
        $setting->delete();
        return redirect()->back()->with('success', 'ساختار با موفقیت بازیابی شد');
    }
    
}
