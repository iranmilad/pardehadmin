<?php

namespace App\Jobs;

use App\Models\Order;
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

    public function __construct(Order $order, $serial, $privateKey, $expirationDate)
    {
        $this->order = $order;
        $this->serial = $serial;
        $this->privateKey = $privateKey;
        $this->expirationDate = strtotime($expirationDate);
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

            $customerData = [
                "name" => $this->order->customer_name,
                "isPurchaser" => true,
                "mobileNumber" => $this->order->customer_phone_number,
                "email" => $this->order->customer_email,
                "postalCode" => $this->order->shipping_postal_code,
                "address" => $this->order->shipping_address,
                "isLegal" => false,
                "thirdPartyAccountCode": "",
                "thirdPartyAccountId":0,
                "isSeller": false,
                "isBlocked": false,
                "isBroker": false,
                "isDebtor": false,
                "nationalCode": "",
                "economicCode": "",
                "creditAmount": 0,
                "phoneNumber": "",
                "faxNumber": "",
                "addressTitle": "",
                "moreAddresses": []
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
            
            if ($response->successful()) {
                Log::info("✅ مشتری با موفقیت ثبت شد: Order ID {$this->order->id}");
                Log::info($response->body()); // مقدار response به درستی لاگ شود
            } else {
                throw new \Exception("❌ خطا در ثبت مشتری: " . $response->body());
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


}
