<?php

namespace App\Http\Controllers;

use App\Models\Gateway;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Artisan;

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
                    'privateKey' => '',
                    'publicKey' => '',
                    'serial' => '',
                    "expirationDate" => "",
                    'service_name' => '',
                    'service_status' => 1,
                    'status' => 1,
                    'invoice_items_no_holo_code' => 0,
                    'status_place_payment' => 'cash',
                    'sales_price_field' => 1,
                    'special_price_field' => 1,
                    'wholesale_price_field' => 1,
                    'product_stock_field' => 1,
                    'update_product_stock'  => 1,
                    'update_product_price' => 1,
                    'update_product_name' => 0,
                    'insert_new_product' => 0,
                    'save_sale_invoice' => 0,
                    'bank_accounts' => [],
                ],
            ]);
        }
        $gateways = Gateway::with('bankAccounts')->get();
        return view('settings.holo', compact('setting', 'gateways'));
    }

    public function update(Request $request)
    {
        // اعتبارسنجی ورودی
        $validatedData = $request->validate([
            'privateKey' => 'nullable|string',
            'publicKey' => 'nullable|string',
            'serial' => 'nullable|string',
            'service_name' => 'nullable|string',
            'service_status' => 'nullable|integer',
            'status' => 'nullable|integer',
            'invoice_items_no_holo_code' => 'nullable|integer',
            'status_place_payment' => 'nullable|string',
            'sales_price_field' => 'nullable|integer',
            'special_price_field' => 'nullable|integer',
            'wholesale_price_field' => 'nullable|integer',
            'product_stock_field' => 'nullable|integer',
            'update_product_stock' => 'nullable|integer',
            'update_product_price' => 'nullable|integer',
            'update_product_name' => 'nullable|integer',
            'insert_new_product' => 'nullable|integer',
            'save_sale_invoice' => 'nullable|integer',
            'config.bank_accounts' => 'nullable|array',
            'config.bank_accounts.*' => 'nullable|string',
        ]);

        \Log::info('Validated Data:', $validatedData);

        // دریافت تنظیمات قبلی
        $setting = Setting::firstOrCreate(
            ['group' => 'holo', 'section' => 'holo'],
            ['settings' => []]
        );

        // مقدار تنظیمات فعلی را با مقدار جدید ادغام کنیم
        $updatedSettings = $setting->settings ?? [];

        // مقادیر جدید را روی تنظیمات اعمال کنیم
        foreach ($validatedData as $key => $value) {
            $updatedSettings[$key] = $value;
        }

        // مقداردهی `bank_accounts`
        if (isset($validatedData['config']['bank_accounts'])) {
            $updatedSettings['bank_accounts'] = $validatedData['config']['bank_accounts'];
        }

        // ذخیره تنظیمات جدید در دیتابیس
        $setting->update(['settings' => $updatedSettings]);

        \Log::info('Updated Settings:', ['settings' => $setting->settings]);

        cache()->forget('settings.holo');

        return redirect()->route('settings.holo.edit')->with('success', 'تنظیمات با موفقیت به‌روزرسانی شد.');
    }




    public function getAttribute(Request $request)
    {
        app('App\Http\Controllers\API\Holo\ProductAttributeController')->fetchAndStoreAttributes($request);
        return redirect()->route('settings.holo.edit')->with('success', 'درخواست ارسال شد.');
    }

    public function getCategory(Request $request)
    {
        app('App\Http\Controllers\API\Holo\CategoryController')->fetchAndStoreCategories($request);
        return redirect()->route('settings.holo.edit')->with('success', 'درخواست ارسال شد.');
    }
    public function importAllProducts(Request $request)
    {
        app('App\Http\Controllers\API\Holo\ProductImportController')->importAllProducts($request);
        return redirect()->route('settings.holo.edit')->with('success', 'درخواست ارسال شد.');
    }

    public function updateAllProducts(Request $request)
    {
        app('App\Http\Controllers\API\Holo\ProductUpdateController')->updateAllProducts($request);
        return redirect()->route('settings.holo.edit')->with('success', 'درخواست ارسال شد.');
    }

    public function deleteJob(){

            // حذف تمام jobهای موجود در جدول jobs
            DB::table('jobs')->truncate();

            // حذف تمام jobهای موجود در جدول failed_jobs
            DB::table('failed_jobs')->truncate();

            // اجرای دستور artisan برای حذف کش صف‌ها
            Artisan::call('queue:flush');

            return back()->with('success', 'تمام jobها با موفقیت حذف شدند.');

    }
}
