<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use App\Models\SmsSetting;
use Illuminate\Http\Request;
use App\Traits\AuthorizeAccess;

class SmsSettingController extends Controller
{
    use AuthorizeAccess;

    public function __construct()
    {
        // تنظیم نام دسترسی مورد نیاز
        $this->permissionName = 'manage_sms_settings';
    }

    public function index(Request $request)
    {
        $query = SmsSetting::query();

        // اعمال فیلتر بر اساس دسترسی‌های کاربر
        $query = $this->applyAccessControl($query);

        $settings = $query->paginate(10);

        return view('settings.sms', compact('settings'));
    }

    public function edit($id)
    {
        $setting = SmsSetting::findOrFail($id);
        return view('sms.edit', compact('setting'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string',
            'value' => 'required|string',
        ]);

        $setting = SmsSetting::findOrFail($id);
        $setting->update($request->all());

        return redirect()->route('settings.sms')->with('success', 'تنظیمات به‌روزرسانی شد.');
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

}
