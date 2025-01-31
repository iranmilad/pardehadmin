<?php

namespace App\Http\Controllers\API\Holo;

use App\Jobs\UpdateProductsPage;
use App\Models\Setting;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProductUpdateController extends Controller
{
    public function updateAllProducts(Request $request)
    {
        // دریافت تنظیمات
        $settings = $this->getSettings();
        if (!$settings) {
            return response()->json(['message' => 'Settings not configured.'], 500);
        }

        // افزودن Job برای دریافت اطلاعات محصولات
        UpdateProductsPage::dispatch($settings)->onQueue('default');

        return response()->json(['message' => 'Product update process has been queued.'], 200);
    }

    private function getSettings()
    {
        $setting = Setting::where('group', 'holo')->where('section', 'holo')->first();
        return $setting ? $setting->settings : null;
    }
}
