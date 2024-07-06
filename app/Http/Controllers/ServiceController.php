<?php
namespace App\Http\Controllers;

use App\Models\Setting;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    public function index()
    {
        $settings = Setting::all();
        return view('settings', compact('settings'));
    }

    public function create()
    {
        return view('settings');
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
            'group' => 'holo',
            'section' => 'config',
            'settings' => $data['settings'],
        ]);

        return redirect()->back()->with('success', 'تنظیمات با موفقیت ذخیره شد.');
    }

    public function edit($group)
    {
        $setting = Setting::where('group', $group)->first();

        // اگر تنظیمات وجود دارد، آن را به ویو پاس بدهید
        if ($setting) {
            //dd($setting);
            return view('settings', compact('setting'));
        }

        // اگر تنظیمات وجود ندارد، یک آرایه خالی به عنوان مقدار پیش‌فرض برای ویو ارسال کنید
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

        // ویو را با استفاده از مقادیر پیش‌فرض ارسال کنید
        return view('settings', $defaultSettings);
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
}
