<?php

namespace App\Jobs;

use App\Models\Order;
use App\Models\Setting;
use Illuminate\Bus\Queueable;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Http;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class RegisterCustomerJob implements ShouldQueue
{
    use Dispatchable, Queueable, SerializesModels, InteractsWithQueue;

    protected $order;
    protected $serial;
    protected $privateKey;
    protected $expirationDate;
    protected $publicKey;
    protected $config;
    protected $settings;

    public function __construct(Order $order, $serial, $privateKey,$publicKey,$config,$settings, $expirationDate)
    {
        $this->order = $order;
        $this->serial = $serial;
        $this->privateKey = $privateKey;
        $this->expirationDate = strtotime($expirationDate);
        $this->publicKey = $publicKey;
        $this->config = $config;
        $this->settings = $settings;
         
    }

    public function handle()
    {
        try {
            if (!$this->isPrivateKeyValid()) {
                Log::info("🔄 توکن منقضی شده، دریافت توکن جدید...");
                $this->privateKey = $this->getNewPrivateKey();
                if (!$this->privateKey) {
                    Log::error("❌ دریافت توکن جدید ناموفق بود. عملیات متوقف شد.");
                    return;
                }
            }
    
            // ✅ استعلام مشتری با شماره موبایل
            $existingCustomer = $this->checkIfCustomerExists($this->order->customer_phone_number);
            if ($existingCustomer) {
                Log::info("ℹ️ مشتری با شماره {$this->order->customer_phone_number} قبلاً ثبت شده است.");
                return;
            }
    
            // ✅ اطلاعات مشتری برای ثبت
            $customerData = [
                "name" => $this->order->customer_name,
                "isPurchaser" => true,
                "mobileNumber" => $this->order->customer_phone_number,
                "email" => $this->order->customer_email,
                "postalCode" => $this->order->shipping_postal_code,
                "address" => $this->order->shipping_address,
                "isLegal" => false,
                "thirdPartyAccountCode" => "",
                "thirdPartyAccountId" => 0,
                "isSeller" => false,
                "isBlocked" => false,
                "isBroker" =>  false,
                "isDebtor" =>  false,
                "nationalCode" => "",
                "economicCode" => "",
                "creditAmount" =>  0,
                "phoneNumber" => "",
                "faxNumber"=> "",
                "addressTitle"=> "",
                "moreAddresses"=>[]
            ];
    
            $response = Http::timeout(60)->withoutVerifying()->withHeaders([
                'serial' => $this->serial,
                'allowDuplicateEconomicCode' => 'false',
                'allowDuplicateNationalCode' => 'false',
                'allowDuplicateMobile' => 'false',
                'Content-Type' => 'application/json',
                'Accept' => 'text/plain',
                'Token' => $this->privateKey,
            ])->post('http://apigw.holoo.cloud/api/Account/PostAccount', $customerData);
    
            $responseBody = $response->json();
    
            if ($response->ok() && isset($responseBody['Status']) && $responseBody['Status'] === true) {
                Log::info("✅ مشتری با موفقیت ثبت شد: Order ID {$this->order->id}");
                Log::info(json_encode($responseBody));
            } else {
                $errorMessage = $responseBody['Message'][0] ?? 'خطای نامشخص';
                throw new \Exception("❌ خطا در ثبت مشتری: {$errorMessage}");
            }
    
        } catch (\Throwable $e) {
            Log::error("⚠️ خطای غیرمنتظره در RegisterCustomerJob: " . $e->getMessage());
            $this->fail($e);
        }
    }
    


    protected function isPrivateKeyValid()
    {
        return time() < $this->expirationDate;
    }

    private function getNewPrivateKey()
    {
        try {
            $url = 'http://mng.holoo.cloud/api/CloudServiceClientsControllers/GetPrivateKey';
            $body = [
                'publicKey' => $this->publicKey,
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
    

    private function checkIfCustomerExists($mobileNumber)
    {
        try {
            $response = Http::timeout(30)->withoutVerifying()->withHeaders([
                'serial' => $this->serial,
                'isResponseOnWebhook' => 'false',
                'Accept' => 'text/plain',
                'Token' => $this->privateKey,
            ])->get('http://apigw.holoo.cloud/api/Account/GetAccounts', [
                'mobileNumber' => $mobileNumber
            ]);
    
            if ($response->successful()) {
                $data = $response->json();
    
                // بررسی اینکه لیست مشتریان در مسیر جدید وجود داشته باشد
                if (
                    isset($data['Data']['content']['list']) &&
                    is_array($data['Data']['content']['list']) &&
                    count($data['Data']['content']['list']) > 0
                ) {
                    return true; // مشتری وجود دارد
                }
    
                return false; // مشتری پیدا نشد
            }
    
            Log::warning("⚠️ دریافت پاسخ ناموفق هنگام استعلام مشتری: " . $response->status());
        } catch (\Throwable $e) {
            Log::error("⚠️ خطا در استعلام مشتری: " . $e->getMessage());
        }
    
        return false;
    }
    

    private function sendCurlRequest($url, $method, $body = [], $headers = [])
    {
        $curl = curl_init();

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
            CURLOPT_HTTPHEADER => $headers,
        ]);

        $response = curl_exec($curl);
        curl_close($curl);

        return json_decode($response, true);
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

}
