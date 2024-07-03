<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use Illuminate\Http\Request;

class HoloSettingController extends Controller
{
    public function edit()
    {
        $setting = Setting::where('group', 'holo')->where('section', 'holo')->first();

        // تنظیمات پیش‌فرض در صورت عدم وجود
        if (!$setting) {
            $setting = new Setting([
                'group' => 'holo',
                'section' => 'holo',
                'settings' => [
                    'username' => '',
                    'password' => '',
                    'license_code' => '',
                    'service_name' => '',
                    'service_status' => 1,
                    'status' => 1,
                    'invoice_items_no_holo_code' => 0,
                    'status_place_payment' => 'cash',
                    'sales_price_field' => 1,
                    'special_price_field' => 1,
                    'wholesale_price_field' => 1,
                    'product_stock_field' => 1,
                    'save_sale_invoice' => 0,
                ],
            ]);
        }

        return view('settings.holo', ['setting' => $setting]);
    }

    public function update(Request $request)
    {
        $request->validate([
            'username' => 'nullable|string',
            'password' => 'nullable|string',
            'license_code' => 'nullable|string',
            'service_name' => 'nullable|string',
            'service_status' => 'nullable|integer',
            'status' => 'nullable|integer',
            'invoice_items_no_holo_code' => 'nullable|integer',
            'status_place_payment' => 'nullable|string',
            'sales_price_field' => 'nullable|integer',
            'special_price_field' => 'nullable|integer',
            'wholesale_price_field' => 'nullable|integer',
            'product_stock_field' => 'nullable|integer',
            'save_sale_invoice' => 'nullable|integer',
        ]);

        $setting = Setting::updateOrCreate(
            ['group' => 'holo', 'section' => 'holo'],
            ['settings' => $request->except('_token')]
        );

        return redirect()->route('settings.holo.edit')->with('success', 'تنظیمات با موفقیت به‌روزرسانی شد.');
    }
}
