<?php

namespace App\Http\Controllers\API\Holo;

use App\Models\Setting;
use Illuminate\Http\Request;
use App\Jobs\ProcessProductPage;
use App\Jobs\FetchAndProcessToken;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Http;

class ProductImportController extends Controller
{
    public function importAllProducts(Request $request)
    {
        // دریافت تنظیمات
        $settings = $this->getSettings();
        if (!$settings) {
            return response()->json(['message' => 'Settings not configured.'], 500);
        }


        FetchAndProcessToken::dispatch($settings)->onQueue('default');


        return response()->json(['message' => 'Product import has been queued for processing.'], 200);
    }

    private function getSettings()
    {
        // دریافت تنظیمات از دیتابیس
        $setting = Setting::where('group', 'holo')->where('section', 'holo')->first();
        return $setting ? $setting->settings : null;
    }
}
