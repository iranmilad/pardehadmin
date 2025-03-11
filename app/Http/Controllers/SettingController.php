<?php
namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Setting;
use App\Models\Category;
use App\Models\Attribute;
use Illuminate\Http\Request;
use App\Traits\AuthorizeAccess;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Artisan;

class SettingController extends Controller
{
    use AuthorizeAccess;

    public function __construct()
    {
        // تنظیم نام دسترسی مورد نیاز
        $this->permissionName = 'manage_settings';
    }

    public function index()
    {
        // ساختن کوئری برای دریافت تنظیمات
        $query = Setting::query();

        // اعمال فیلتر بر اساس دسترسی‌های کاربر
        $query = $this->applyAccessControl($query);

        // دریافت تمام تنظیمات
        $settings = $query->get();

        return view('settings.index', compact('settings'));
    }


    public function create()
    {
        return view('settings.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'settings.logo' => 'nullable|url',
            'settings.favicon' => 'nullable|url',
            'settings.site_url' => 'required|url',
            'settings.site_title' => 'required|string',
            'settings.copyright' => 'required|string',
            'settings.admin_email' => 'required|email',
            'settings.meta_tags' => 'nullable|string',
            'settings.address_1' => 'nullable|string',
            'settings.address_2' => 'nullable|string',
            'settings.phone_1' => 'nullable|string',
            'settings.phone_2' => 'nullable|string',
            'settings.postal_code' => 'nullable|string',
            'settings.location' => 'nullable|string',
            'settings.maintenance_mode' => 'nullable|boolean',
            'settings.maintenance_message' => 'nullable|string',
            'settings.maintenance_start' => 'nullable|date',
            'settings.maintenance_end' => 'nullable|date',
        ]);

        // Handle file uploads
        if ($request->filled('settings.logo')) {
            $data['settings']['logo'] = $request->input('settings.logo');
        }
        if ($request->filled('settings.favicon')) {
            $data['settings']['favicon'] = $request->input('settings.favicon');
        }

        Setting::create([
            'group' => 'general',
            'section' => 'main',
            'settings' => $data['settings'],
        ]);

        return redirect()->back()->with('success', 'تنظیمات با موفقیت ذخیره شد.');
    }
    public function edit($group)
    {
        $setting = Setting::where('group', $group)->first();

        if ($group == "general") {
            $view = 'settings';
            // مقادیر پیش‌فرض برای تنظیمات عمومی
            $defaultSettings = [
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
        elseif ($group == "sms") {
            $view = 'settings.sms';
            // مقادیر پیش‌فرض برای تنظیمات پیامک
            $defaultSettings = [
                'settings' => [
                    'service' => '',
                    'username' => '',
                    'password' => '',
                    'sender_phone' => '',
                    'domain' => '',
                ],
            ];
            $defaultSettings = (object)$defaultSettings;
        }

        //dd($setting);
        if ($setting) {
            return view($view, compact('setting'));
        }

        // ویو را با استفاده از مقادیر پیش‌فرض ارسال کنید
        return view($view, $defaultSettings);
    }



    public function update(Request $request, $group)
    {

        $data = $request->validate([
            'settings.logo' => 'nullable|url',
            'settings.favicon' => 'nullable|url',
            'settings.site_url' => 'required|url',
            'settings.site_title' => 'required|string',
            'settings.copyright' => 'required|string',
            'settings.admin_email' => 'required|email',
            'settings.meta_tags' => 'nullable|string',
            'settings.address_1' => 'nullable|string',
            'settings.address_2' => 'nullable|string',
            'settings.phone_1' => 'nullable|string',
            'settings.phone_2' => 'nullable|string',
            'settings.postal_code' => 'nullable|string',
            'settings.location' => 'nullable|string',
            'settings.maintenance_mode' => 'nullable|boolean',
            'settings.maintenance_message' => 'nullable|string',
            'settings.maintenance_start' => 'nullable|date',
            'settings.maintenance_end' => 'nullable|date',
        ]);


        $setting = Setting::where('group', $group)->first();
        if (!$setting) {
            $this->store($request);
        }

        // Handle file uploads
        if ($request->filled('settings.logo')) {
            $data['settings']['logo'] =  $request->input('settings.logo');
        }
        if ($request->filled('settings.favicon')) {
            $data['settings']['favicon'] = $request->input('settings.favicon');

        }

        $setting->update([
            'settings' => $data['settings'],
        ]);

        return redirect()->back()->with('success', 'تنظیمات با موفقیت بروزرسانی شد.');
    }

    public function delete(Request $request)
    {
        $setting = Setting::findOrFail($request->id);
        $setting->delete();

        return redirect()->back()->with('success', 'تنظیمات با موفقیت حذف شد.');
    }

    public function bulk_action(Request $request)
    {
        // منطق مورد نظر برای انجام عملیات دسته‌ای
        return redirect()->back()->with('success', 'عملیات دسته‌ای با موفقیت انجام شد.');
    }

    public function updateSms(Request $request)
    {
        $data = $request->validate([
            'settings.service' => 'required|string',
            'settings.username' => 'required|string',
            'settings.password' => 'required|string',
            'settings.sender_phone' => 'required|string',
            'settings.domain' => 'required|url',
        ]);

        // دریافت تنظیمات مربوط به گروه sms
        $setting = Setting::where('group', 'sms')->first();

        if ($setting) {
            // اگر تنظیمات موجود است، آن را به‌روزرسانی کنید
            $setting->update([
                'settings' => $data['settings'],
            ]);
        } else {
            // اگر تنظیمات موجود نیست، آن را ایجاد کنید
            Setting::create([
                'group' => 'sms',
                'section' => 'main',
                'settings' => $data['settings'],
            ]);
        }

        return redirect()->back()->with('success', 'تنظیمات پیامک با موفقیت بروزرسانی شد.');
    }

    public function editSms()
    {
        $setting = Setting::where('group', 'sms')->first();


            $view = 'settings.sms';
            // مقادیر پیش‌فرض برای تنظیمات پیامک
            $defaultSettings = [
                'settings' => [
                    'service' => '',
                    'username' => '',
                    'password' => '',
                    'sender_phone' => '',
                    'domain' => '',
                ],
            ];
            $defaultSettings = (object)$defaultSettings;


        //dd($setting);
        if ($setting) {
            return view($view, compact('setting'));
        }

        // ویو را با استفاده از مقادیر پیش‌فرض ارسال کنید
        return view($view, $defaultSettings);
    }

    public function settingsMaintenance(){

        return view('settingsMaintenance');
    }


    /**
     * حذف تمام دسته‌بندی‌ها و زیردسته‌های آن‌ها
     */
    public function clearAllCategory()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        Category::truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        return redirect()->back()->with('success', 'تمام دسته‌بندی‌ها با موفقیت حذف شدند.');
    }

    /**
     * حذف تمام ویژگی‌ها و مقادیر مربوط به آن‌ها
     */
    public function clearAllAttribute()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        Attribute::truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        return redirect()->back()->with('success', 'تمام ویژگی‌ها با موفقیت حذف شدند.');
    }

    /**
     * حذف تمام محصولات و ترکیب‌های مربوطه
     */
    public function clearAllProducts()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        Product::truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        return redirect()->back()->with('success', 'تمام محصولات با موفقیت حذف شدند.');
    }

    /**
     * حذف تمام عملیات‌های برنامه‌ریزی شده (Job ها)
     */
    public function deleteJob()
    {
        Artisan::call('queue:clear');

        return redirect()->back()->with('success', 'تمام عملیات‌های برنامه‌ریزی شده حذف شدند.');
    }


}
