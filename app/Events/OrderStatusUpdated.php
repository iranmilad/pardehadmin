<?php

namespace App\Events;

use App\Models\Order;
use App\Models\Setting;
use App\Jobs\RegisterCustomerJob;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Http;
use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class OrderStatusUpdated
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $order;
    public $oldStatus;
    public $newStatus;

    public function __construct(Order $order, $oldStatus, $newStatus)
    {
        $this->order = $order;
        $this->oldStatus = $oldStatus;
        $this->newStatus = $newStatus;

        if ($newStatus === 'processing') {
            $this->handleProcessingStatus();
        }
    }

    private function handleProcessingStatus()
    {
        $settings = $this->getUserSettings();
        if (!$settings) {
            Log::error("⚠️ تنظیمات هلو یافت نشد.");
            return;
        }

        $serial = $settings['serial'] ?? null;
        $privateKey = $this->ensureValidprivateKey($settings);
        $expirationDate = $settings['expirationDate'] ?? null;

        if (!$privateKey) {
            Log::error("❌ توکن معتبر یافت نشد.");
            return;
        }

        RegisterCustomerJob::dispatch($this->order, $serial, $privateKey, $expirationDate);
    }

    private function getUserSettings()
    {
        $setting = Setting::where('group', 'holo')->where('section', 'holo')->first();
        return $setting ? $setting->settings : null;
    }

    private function ensureValidprivateKey($settings)
    {
        $expiration = isset($settings['expirationDate']) ? strtotime($settings['expirationDate']) : 0;
        $now = time();

        if ($now < $expiration && isset($settings['privateKey'])) {
            Log::info("✅ توکن معتبر است.");
            return $settings['privateKey'];
        }

        Log::info("🔄 دریافت توکن جدید...");
        return $this->getNewprivateKey($settings['publicKey'] ?? null);
    }

    private function getNewprivateKey($publicKey)
    {
        try {
            $url = 'http://mng.holoo.cloud/api/CloudServiceClientsControllers/GetPrivateKey';
            $body = [
                'publicKey' => $publicKey,
            ];
    
            $data = $this->sendCurlRequest($url, 'POST', $body);
            
            if ($data['Status'] ?? false) {
                if (isset($data['Data']['privateKey'], $data['Data']['expirationDate'])) {
                    $newprivateKey = $data['Data']['privateKey'];
                    $expiration = date('Y-m-d H:i:s', strtotime($data['Data']['expirationDate']));
                    $this->updateprivateKeyInDatabase($newprivateKey, $expiration);
                    return $newprivateKey;
                }
            }
    

        } catch (\Throwable $e) {
            Log::error("⚠️ خطا در دریافت توکن جدید: " . $e->getMessage());
        }
        return null;
    }

    private function updateprivateKeyInDatabase($privateKey, $expiration)
    {
        try {
            $setting = Setting::where('group', 'holo')->where('section', 'holo')->first();
            if ($setting) {
                $settingsData = $setting->settings;
                $settingsData['privateKey'] = $privateKey;
                $settingsData['expirationDate'] = $expiration;
                $setting->settings = $settingsData;
                $setting->save();
                Log::info("✅ توکن جدید و تاریخ انقضا ذخیره شد.");
            } else {
                Log::error("⚠️ امکان ذخیره‌سازی توکن وجود ندارد.");
            }
        } catch (\Throwable $e) {
            Log::error("⚠️ خطا در ذخیره‌سازی توکن: " . $e->getMessage());
        }
    }

    private function sendCurlRequest($url, $method, $body = [], $headers = [])
    {
        $curl = curl_init();

        $defaultHeaders = [
            'Content-Type: application/json',
        ];

        curl_setopt_array($curl, [
            CURLOPT_URL => $url,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
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
}
