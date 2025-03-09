<?php

namespace App\Jobs;

use App\Models\Product;
use App\Models\Setting;
use Illuminate\Bus\Queueable;
use Illuminate\Support\Facades\Http;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class UpdateProductsPage implements ShouldQueue
{
    use Dispatchable, Queueable, InteractsWithQueue, SerializesModels;

    protected $settings;

    public function __construct($settings)
    {
        $this->settings = $settings;
    }

    public function handle()
    {
        $settings = $this->settings;

        // بررسی یا دریافت توکن
        $token = $this->ensureToken($settings);

        if ($token) {
            // دریافت اطلاعات محصولات
            $this->fetchAndUpdateProducts($settings, $token);
        } else {
            logger()->error('Failed to fetch or validate token.');
        }
    }

    private function ensureToken($settings)
    {
        // بررسی انقضای توکن
        if (empty($settings['privateKey']) || $this->isPrivateKeyExpired($settings)) {
            $response = $this->fetchPrivateKey($settings['publicKey']);
            if ($response['success']) {
                // ذخیره کلید و تاریخ انقضا در تنظیمات
                $setting = Setting::where('group', 'holo')->where('section', 'holo')->first();
                if ($setting) {
                    $updatedSettings = $setting->settings;
                    $updatedSettings['privateKey'] = $response['privateKey'];
                    $updatedSettings['expirationDate'] = $response['expirationDate'];
                    $setting->update(['settings' => $updatedSettings]);
                }

                return $response['privateKey'];
            }

            return null;
        }

        return $settings['privateKey'];
    }

    private function isPrivateKeyExpired($settings)
    {
        $expirationDate = $settings['expirationDate'] ?? null;
        if ($expirationDate) {
            return now()->greaterThan($expirationDate);
        }
        return true;
    }

    private function fetchPrivateKey($publicKey)
    {
        $url = 'http://mng.holoo.cloud:85/api/CloudServiceClientsControllers/GetPrivateKey';
        $body = [
            'publicKey' => $publicKey,
        ];

        $response = Http::withoutVerifying()->post($url, $body);

        if ($response->successful() && $response->json('Status')) {
            $data = $response->json('Data', []);
            return [
                'success' => true,
                'privateKey' => $data['privateKey'] ?? '',
                'expirationDate' => $data['expirationDate'] ?? '',
            ];
        }

        return [
            'success' => false,
            'message' => $response->json('Message') ?? 'Unknown error',
        ];
    }

    private function fetchAndUpdateProducts($settings, $token)
    {
        $url = 'http://apigw.holoo.cloud:82/api/Product/GetProduct';
        $response = Http::withoutVerifying()->withHeaders([
            'serial' => $settings['serial'],
            'Accept' => 'text/plain',
            'Token' => $token,
            'isResponseOnWebhook' => 'false',
        ])->get($url . '?page=1&itemsPerPage=100&getAttributes=true');

        if ($response->successful() && $response->json('Data.isSuccess')) {
            $totalPages = $response->json('Data.content.totalPages');

            for ($page = 1; $page <= $totalPages; $page++) {
                // صف‌بندی عملیات پردازش برای هر صفحه
                UpdateSingleProductPage::dispatch($url, $settings['serial'], $token, $page,$this->settings)->onQueue('default');
            }
        } else {
            logger()->error('Failed to fetch product data.');
        }
    }
}
