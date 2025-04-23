<?php

namespace App\Jobs;

use App\Models\Order;
use App\Models\Setting;
use Illuminate\Bus\Queueable;
use Illuminate\Support\Facades\Log;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class RegisterInvoiceJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

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
        $this->expirationDate = $expirationDate;
        $this->publicKey = $publicKey;
        $this->config = $config; 
        $this->settings = $settings;
    }

    public function handle()
    {
        $privateKey = $this->ensureValidPrivateKey();
        if (!$privateKey) {
            Log::error("❌ توکن معتبر برای ثبت فاکتور وجود ندارد.");
            return;
        }

        // دریافت customerCode از شماره موبایل در صورت نبودن
        
        if ($this->order->customer_phone_number) {
            if($this->settings["save_sale_invoice"]==1){
                $customerCode = $this->getCustomerCodeByMobile($this->order->customer_phone_number, $privateKey);
            }
            else{
                $customerCode = $this->getCustomerCodeByMobile("09100000000", $privateKey);
            }
            if (!$customerCode) {
                Log::error("❌ کد مشتری یافت نشد، ثبت فاکتور انجام نشد.");
                return;
            }
        }

        $url = 'http://apigw.holoo.cloud/api/Invoice/PostInvoice';

        $order = Order::with(['orderItems.combination', 'orderItems.product'])->find($this->order->id);

        $cashAmount = 0;
        $invoiceItems = [];
        
        foreach ($order->orderItems as $item) {
            $attributeInfos = [];
        
            if ($item->combination) {
                $combination = $item->combination;
                if(!$combination->holo_code and $this->settings["invoice_items_no_holo_code"]==1){
                    continue;
                }
                elseif(!$combination->holo_code){
                    Log::error('❌ عدم ثبت فاکتور.ایتم فاکتور فاقد کد هلو است');
                }
                $parts = explode('*', $combination->holo_code);
                $productCode = $parts[0] ?? null;
                $attributeId = $parts[1] ?? null;
        
                $unitPrice = $combination->sale_price ?? $combination->price;
        
                if ($attributeId) {
                    $attributeInfos[] = [
                        'attributeId' => (int)$attributeId,
                        'few' => $item->quantity
                    ];
                }
            } 
            else {
                $product = $item->product;
                if(!$product->holo_code and $this->settings["invoice_items_no_holo_code"]==1){
                    continue;
                }
                elseif(!$product->holo_code){
                    Log::error('❌ عدم ثبت فاکتور.ایتم فاکتور فاقد کد هلو است');
                }
                $productCode = $product->holo_code ?? $product->sku;
                $unitPrice = $product->sale_price ?? $product->price;
            }
        
            // جمع کل قیمت آیتم‌ها
            $cashAmount += $unitPrice * $item->quantity;
        
            $invoiceItem = [
                'productCode' => $productCode,
                'few' => $item->quantity,
                'unitPrice' => $unitPrice,
                "itemValueAddTax" => 0,
                "itemToll" => 0,
                "itemComment" => 0,
            ];
            
            // فقط اگر attributeInfos داده‌ای داشته باشد، اضافه شود
            if (!empty($attributeInfos)) {
                $invoiceItem["attributeInfos"] = $attributeInfos;
            }
            
            $invoiceItems[] = $invoiceItem;
            
        }
        $gatewayId = $order->payment->gateway->id ?? null;

        $cashAccountingCode = $this->config["bank_accounts"][$gatewayId] ?? '10100010001';
        
        $body = [
            'thirdPartyInvoiceId' => '',
            'customerCode' => $customerCode,
            'invoiceDateTime' => now()->toIso8601String(),
            'cashAmount' => $cashAmount,
            'posAmount' => 0,
            'onCreditAmount' => 0,
            'cashAccountingCode' => $cashAccountingCode,
            'posAccountingCode' => '',
            'chequeAmount' => 0,
            'discountPercent' => 0,
            'discountAmount' => 0,
            'comment' => 'ثبت فاکتور از طریق سایت ساز',
            'invoiceItems' => $invoiceItems,
        ];
        

        Log::info('📦 ارسال فاکتور به هلو:', $body);

        $headers = [
            'serial: ' . $this->serial,
            'Content-Type: application/json',
            'Accept: text/plain',
            'Token: ' . $privateKey,
        ];

        $response = $this->sendCurlRequest($url, 'POST', $body, $headers);

        if ($response['Status'] ?? false) {
            Log::info('✅ فاکتور با موفقیت ثبت شد.');
        } else {
            Log::error('❌ خطا در ثبت فاکتور:', ['response' => $response]);
        }
    }

    private function ensureValidPrivateKey()
    {
        $now = time();
        $expiration = strtotime($this->expirationDate);

        if ($now < $expiration) {
            return $this->privateKey;
        }

        Log::info("🔄 توکن منقضی شده، دریافت توکن جدید...");

        $setting = Setting::where('group', 'holo')->where('section', 'holo')->first();
        $settings = $setting->settings ?? [];
        $publicKey = $settings['publicKey'] ?? null;

        if (!$publicKey) {
            Log::error("⚠️ کلید عمومی برای دریافت توکن وجود ندارد.");
            return null;
        }

        $newTokenData = $this->getNewPrivateKey($publicKey);
        if ($newTokenData && isset($newTokenData['privateKey'])) {
            $settings['privateKey'] = $newTokenData['privateKey'];
            $settings['expirationDate'] = $newTokenData['expirationDate'];
            $setting->settings = $settings;
            $setting->save();

            Log::info("✅ توکن جدید با موفقیت ذخیره شد.");
            return $newTokenData['privateKey'];
        }

        return null;
    }

    private function getNewPrivateKey($publicKey)
    {
        $url = 'http://mng.holoo.cloud/api/CloudServiceClientsControllers/GetPrivateKey';
        $body = ['publicKey' => $publicKey];

        $response = $this->sendCurlRequest($url, 'POST', $body);

        if ($response['Status'] ?? false) {
            return [
                'privateKey' => $response['Data']['privateKey'] ?? null,
                'expirationDate' => date('Y-m-d H:i:s', strtotime($response['Data']['expirationDate'] ?? '')),
            ];
        }

        Log::error("⚠️ دریافت توکن جدید ناموفق بود:", ['response' => $response]);
        return null;
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

    private function getCustomerCodeByMobile($mobile, $privateKey)
    {
        $url = "http://apigw.holoo.cloud/api/Account/GetAccounts?mobileNumber={$mobile}";
    
        $headers = [
            'serial: ' . $this->serial,
            'isResponseOnWebhook: false',
            'Accept: text/plain',
            'Token: ' . $privateKey,
        ];
    
        $response = $this->sendCurlRequest($url, 'GET', [], $headers);
    
        if (
            isset($response['Data']['content']['list']) &&
            is_array($response['Data']['content']['list']) &&
            count($response['Data']['content']['list']) > 0
        ) {
            $first = $response['Data']['content']['list'][0];
            if (isset($first['code'])) {
                Log::info("📲 کد مشتری با موبایل {$mobile} یافت شد: {$first['code']}");
                return $first['code'];
            }
        }
    
        Log::warning("📵 هیچ مشتری‌ای با شماره {$mobile} پیدا نشد.", ['response' => $response]);
        return null;
    }
    
}
