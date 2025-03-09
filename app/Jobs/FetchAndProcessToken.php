<?php

namespace App\Jobs;

use Throwable;
use App\Models\Setting;
use Illuminate\Bus\Queueable;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Http;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class FetchAndProcessToken implements ShouldQueue
{
    use Dispatchable, Queueable, InteractsWithQueue, SerializesModels;
    public $timeout = 60; // حداکثر زمان اجرای این جاب
    public $tries = 1; // فقط یکبار اجرا شود، در صورت شکست تکرار نشود
    protected $settings;

    public function __construct($settings)
    {
        $this->settings = $settings;
    }

    public function handle()
    {
        try {
            $settings = $this->settings;

            // بررسی یا دریافت توکن
            $token = $this->ensureToken($settings);
            if ($token) {
                // اگر توکن موفقیت‌آمیز بود، درخواست محصول را ارسال می‌کنیم
                $this->fetchProductData($settings, $token);
            } else {
                throw new \Exception('Failed to fetch or validate token.');
            }
        } catch (Throwable $e) {
            Log::error('FetchAndProcessToken Job failed: ' . $e->getMessage());
            $this->fail($e); // این جاب را به عنوان fail ثبت می‌کند
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
        $body = ['publicKey' => $publicKey];

        try {
            $response = Http::timeout($this->timeout)->withoutVerifying()->post($url, $body);

            if ($response->successful() && $response->json('Status')) {
                $data = $response->json('Data', []);
                return [
                    'success' => true,
                    'privateKey' => $data['privateKey'] ?? '',
                    'expirationDate' => $data['expirationDate'] ?? '',
                ];
            }

            throw new \Exception($response->json('Message') ?? 'Unknown error');
        } catch (Throwable $e) {
            Log::error('Failed to fetch private key: ' . $e->getMessage());
            return ['success' => false, 'message' => $e->getMessage()];
        }
    }

    private function fetchProductData($settings, $token)
    {
        $url = 'http://apigw.holoo.cloud:82/api/Product/GetProduct';

        try {
            $response = Http::timeout($this->timeout)->withoutVerifying()->withHeaders([
                'serial' => $settings['serial'],
                'Accept' => 'text/plain',
                'Token' => $token,
                'isResponseOnWebhook' => 'false',
            ])->get($url . '?page=1&itemsPerPage=100&getAttributes=true');

            if ($response->successful() && $response->json('Data.isSuccess')) {
                $totalPages = $response->json('Data.content.totalPages');

                for ($page = 1; $page <= $totalPages; $page++) {
                    ProcessProductPage::dispatch($url, $settings['serial'], $token, $page)->onQueue('default');
                }
            } else {
                throw new \Exception('Failed to fetch product data.');
            }
        } catch (Throwable $e) {
            Log::error('Error fetching product data: ' . $e->getMessage());
            $this->fail($e);
        }
    }
}
