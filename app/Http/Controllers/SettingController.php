<?php
namespace App\Http\Controllers;

use App\Models\Setting;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    public function index()
    {
        $settings = Setting::all();
        return view('settings.index', compact('settings'));
    }

    public function create()
    {
        return view('settings.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'settings.logo' => 'nullable|image',
            'settings.favicon' => 'nullable|image',
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
        if ($request->hasFile('settings.logo')) {
            $data['settings']['logo'] = $request->file('settings.logo')->store('logos');
        }
        if ($request->hasFile('settings.favicon')) {
            $data['settings']['favicon'] = $request->file('settings.favicon')->store('favicons');
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
            'settings.logo' => 'nullable|image',
            'settings.favicon' => 'nullable|image',
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
        if ($request->hasFile('settings.logo')) {
            $data['settings']['logo'] = $request->file('settings.logo')->store('logos');
        }
        if ($request->hasFile('settings.favicon')) {
            $data['settings']['favicon'] = $request->file('settings.favicon')->store('favicons');
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

}
