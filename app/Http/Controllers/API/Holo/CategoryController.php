<?php

namespace App\Http\Controllers\API\Holo;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;

class CategoryController extends Controller
{
    public function fetchAndStoreCategories(Request $request)
    {
        // دریافت تنظیمات کاربر
        $settings = $this->getUserSettings();
        if (!$settings) {
            return response()->json(['message' => 'User settings not configured'], 500);
        }

        // اطمینان از وجود توکن معتبر
        $token = $this->ensureToken($settings);

        // دریافت داده‌های دسته‌بندی‌ها
        $categoriesData = $this->getCategoriesFromHolo($settings["serial"], $token);
        if (!$categoriesData['success']) {
            return response()->json(['message' => 'Failed to fetch categories', 'error' => $categoriesData['error']], 500);
        }

        // ذخیره دسته‌بندی‌ها در دیتابیس
        $this->storeCategories($categoriesData['categories']);

        return response()->json(['message' => 'Categories stored successfully'], 200);
    }

    private function getUserSettings()
    {
        $setting = \App\Models\Setting::where('group', 'holo')->where('section', 'holo')->first();
        return $setting ? $setting->settings : null;
    }

    private function ensureToken(&$settings)
    {
        if (empty($settings['privateKey']) || $this->isPrivateKeyExpired($settings)) {
            $response = $this->fetchPrivateKey($settings['publicKey']);
            if ($response['success']) {
                $settings['privateKey'] = $response['privateKey'];
                $settings['expirationDate'] = $response['expirationDate'];

                $setting = \App\Models\Setting::where('group', 'holo')->where('section', 'holo')->first();
                if ($setting) {
                    $updatedSettings = $setting->settings;
                    $updatedSettings['privateKey'] = $response['privateKey'];
                    $updatedSettings['expirationDate'] = $response['expirationDate'];
                    $setting->update(['settings' => $updatedSettings]);
                }
            } else {
                throw new \Exception('Failed to fetch private key: ' . $response['message']);
            }
        }

        return $settings['privateKey'];
    }

    private function isPrivateKeyExpired($settings)
    {
        $expirationDate = $settings['expirationDate'] ?? null;
        if ($expirationDate) {
            $now = now();
            return $now->greaterThan($expirationDate);
        }
        return true;
    }

    private function fetchPrivateKey($publicKey)
    {
        $url = 'http://mng.holoo.cloud/api/CloudServiceClientsControllers/GetPrivateKey';
        $body = [
            'publicKey' => $publicKey,
        ];

        $response = $this->sendCurlRequest($url, 'POST', $body);

        if ($response['Status'] ?? false) {
            $data = $response['Data'] ?? [];
            return [
                'success' => true,
                'privateKey' => $data['privateKey'] ?? '',
                'expirationDate' => $data['expirationDate'] ?? '',
            ];
        }

        return [
            'success' => false,
            'message' => $response['Message'] ?? 'Unknown error',
        ];
    }

    private function getCategoriesFromHolo($serial, $token)
    {
        $url = 'http://apigw.holoo.cloud/api/Product/GetSideGroup';
        $headers = [
            'serial: ' . $serial,
            'Accept: text/plain',
            'Token: ' . $token,
            'isResponseOnWebhook: false',
        ];

        $response = $this->sendCurlRequest($url, 'GET', [], $headers);

        if ($response['Data']['isSuccess'] ?? false) {
            return ['success' => true, 'categories' => $response['Data']['content']['list']];
        }

        return ['success' => false, 'error' => $response['Data']['messages'][0] ?? 'Unknown error'];
    }

    private function sendCurlRequest($url, $method, $body = [], $headers = [])
    {
        $curl = curl_init();

        $defaultHeaders = [
            'Content-Type: application/json',
        ];

        curl_setopt_array($curl, [
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_SSL_VERIFYPEER => false,
            CURLOPT_CUSTOMREQUEST => $method,
            CURLOPT_POSTFIELDS => json_encode($body),
            CURLOPT_HTTPHEADER => array_merge($defaultHeaders, $headers),
        ]);

        $response = curl_exec($curl);
        curl_close($curl);

        return json_decode($response, true);
    }

    private function storeCategories($categories)
    {
        foreach ($categories as $categoryData) {
            // تولید عنوان یکتا و alias برای دسته اصلی
            $mainGroupTitle = $categoryData['mainGroupName'];
            $mainGroupAlias = $this->generateUniqueAlias($categoryData['mainGroupName']);

            // ذخیره دسته اصلی
            $parentCategory = Category::firstOrCreate(
                ['title' => $mainGroupTitle],
                [
                    'description' => $categoryData['comment'] ?? '',
                    'alias' => $mainGroupAlias,
                    'parent_id' => null
                ]
            );

            // تولید عنوان یکتا و alias برای زیرمجموعه
            $subGroupTitle = $categoryData['name'];
            $subGroupAlias = $this->generateUniqueAlias($categoryData['name']);

            // ذخیره زیرمجموعه
            Category::firstOrCreate(
                ['title' => $subGroupTitle],
                [
                    'description' => $categoryData['comment'] ?? '',
                    'alias' => $subGroupAlias,
                    'parent_id' => $parentCategory->id
                ]
            );
        }
    }


    private function generateUniqueAlias($name)
    {
        // جایگزینی فاصله‌ها با `-` و پاکسازی کاراکترهای غیرمجاز
        $baseAlias = preg_replace('/\s+/', '-', trim($name));
        $baseAlias = preg_replace('/[^A-Za-z0-9\-آ-ی]/u', '', $baseAlias); // حذف کاراکترهای غیرمجاز
        $baseAlias = mb_strtolower($baseAlias); // کوچک کردن حروف

        $alias = $baseAlias;
        $counter = 1;

        // بررسی یکتایی
        while (Category::where('alias', $alias)->exists()) {
            $alias = $baseAlias . '-' . $counter;
            $counter++;
        }

        return $alias;
    }

    private function generateUniqueTitle($title)
    {
        $baseTitle = trim($title); // حذف فاصله‌های اضافی
        $uniqueTitle = $baseTitle;
        $counter = 1;

        // بررسی یکتایی
        while (Category::where('title', $uniqueTitle)->exists()) {
            $uniqueTitle = $baseTitle . ' (' . $counter . ')'; // افزودن شمارنده برای یکتایی
            $counter++;
        }

        return $uniqueTitle;
    }


}
