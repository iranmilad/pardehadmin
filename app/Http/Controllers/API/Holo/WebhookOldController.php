<?php

namespace App\Http\Controllers\API\Holo;

use App\Models\Product;
use App\Models\Setting;
use App\Models\Category;
use App\Models\Property;
use App\Models\Attribute;
use Illuminate\Http\Request;
use App\Models\AttributeProduct;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use App\Models\ProductAttributeProperty;
use App\Models\ProductAttributeCombination;

class WebhookOldController extends Controller
{
    public function handleWebhook(Request $request)
    {
        // {
        //     "Dbname": "S11216632_holoo1",
        //     "Table": "Article",
        //     "MsgType": "0",
        //     "MsgValue": "0101001,0907057,0914097,0914098,0914099",
        //     "MsgError": "",
        //     "Message": "درج کالا"
        //   }
        // {
        //     "Dbname": "S11216632_holoo1",
        //     "Table": "Article",
        //     "MsgType": "1",
        //     "MsgValue": "0101001,0907057,0914097,0914098,0914099",
        //     "MsgError": "",
        //     "Message": "ویرایش"
        //   }
        Log::info("Webhook Received: " . json_encode($request->all()));

        // بررسی ساختار درخواست
        if (!$request->has(['Table', 'MsgValue', 'Message','MsgType','Dbname']) or $request->has(['MoreInfo']) ) {
            return response()->json(['message' => 'Invalid Webhook Payload'], 400);
        }

        $action = strtolower($request->MsgType);
        $table = strtolower($request->Table);

        $productCodes = explode(",",$request->MsgValue);
        // دریافت تنظیمات کاربر
        $settings = $this->getUserSettings();
        if (!$settings) {
            return response()->json(['message' => 'User settings not configured'], 500);
        }

        // اطمینان از وجود توکن معتبر
        $token = $this->ensureToken($settings);
        $serial = $settings["serial"];


        // دریافت اطلاعات محصول
        if($table=="article"){
            $productsData = $this->getProductsFromHolo($serial, $productCodes, $token);
        }

        
        if (!$productsData['success']) {
            return response()->json(['message' => 'Failed to fetch products', 'error' => $productsData['error']], 500);
        }
        $products = $productsData['products'];
        

        foreach ($products as $productData) {
            if ($action == '1') {
                $this->handleUpdateProduct($productData, $settings);
            } elseif ($action == '0') {
                $this->handleInsertProduct($productData, $settings);
            }
        }

        return response()->json(['message' => 'Operation completed successfully'], 200);
    }

    private function getUserSettings()
    {
        $setting = Setting::where('group', 'holo')->where('section', 'holo')->first();
        return $setting ? $setting->settings : null;
    }

    private function ensureToken(&$settings)
    {
        // بررسی وجود توکن و تاریخ انقضا
        if (empty($settings['privateKey']) || $this->isPrivateKeyExpired($settings)) {
            //dd($settings['publicKey']);
            $response = $this->fetchPrivateKey($settings['publicKey']);
            if ($response['success']) {
                $settings['privateKey'] = $response['privateKey'];
                $settings['expirationDate'] = $response['expirationDate'];

                // ذخیره توکن به‌روزرسانی‌شده در تنظیمات دیتابیس
                $setting = Setting::where('group', 'holo')->where('section', 'holo')->first();
                if ($setting) {
                    $updatedSettings = $setting->settings;
                    $updatedSettings['privateKey'] = $response['privateKey'];
                    $updatedSettings['expirationDate'] = $response['expirationDate'];
                    $setting->update(['settings' => $updatedSettings]);
                }
            } else {

                throw new \Exception('Failed to fetch private key: ' . $response['message'][0]);
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

    private function getProductsFromHolo($serial, $productCodes, $token)
    {
        if (empty($productCodes)) {
            return ['success' => false, 'error' => 'Product codes are empty'];
        }
        
        // فقط کد اصلی را نگه می‌داریم (در صورت وجود dash)
        $cleanCodes = array_map(function ($code) {
            return explode('-', $code)[0];
        }, $productCodes);

       
        // تقسیم به دسته‌های 100تایی
        $chunks = array_chunk($cleanCodes , 100);
        $results = [];
    
        foreach ($chunks as $chunk) {
            // ساخت query string اولیه
            $query = http_build_query([
                'page' => 1,
                'itemsPerPage' => 100,
                'getAttributes' => 'true',
            ]);
    
            // اضافه کردن کدهای کالا به query
            foreach ($chunk as $code) {
                $query .= '&productCodes=' . urlencode($code);
            }
    
            $url = 'http://apigw.holoo.cloud/api/Product/GetProduct?' . $query;
            

            $headers = [
                'serial: ' . $serial,
                'Accept: text/plain',
                'Token: ' . $token,
                'isResponseOnWebhook: false',
            ];
    
            $response = $this->sendCurlRequest($url, 'GET', [], $headers);
           
            // بررسی پاسخ
            if ($response['Data']['isSuccess'] ?? false) {
                $list = $response['Data']['content']['list'] ?? [];
                $results = array_merge($results, $list);
            } else {
                \Log::error("Failed to fetch products for chunk: " . ($response['Data']['messages'][0] ?? 'error'));
            }
        }
    
        if (!empty($results)) {
            return ['success' => true, 'products' => $results];
        }
    
        return ['success' => false, 'error' => 'Failed to fetch any products'];
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

    private function handleUpdateProduct($productData, $settings)
    {
        if (!empty($productData['attributeInfos'])) {
            $this->updateVariableProduct($productData, $settings);
            $this->updateSimpleProduct($productData, $settings);
        } else {
            $this->updateSimpleProduct($productData, $settings);
        }
    }

    private function handleInsertProduct($productData, $settings)
    {
        if (!empty($productData['attributeInfos'])) {
            $this->insertVariableProduct($productData, $settings);
        } else {
            $this->insertSimpleProduct($productData, $settings);
        }
    }

    private function updateSimpleProduct($productData, $settings)
    {
        $product = Product::where('holo_code', $productData['code'])->first();

        if ($product) {
            $updateData = [];

            if ($settings['update_product_name'] ?? 0) {
                $updateData['title'] = $productData['name'];
                $updateData['description'] = $productData['comment'] ?? '';

            }

            if ($settings['update_product_price'] ?? 0) {
                $updateData['price'] = $this->getPriceFromSettings($settings['sales_price_field'], $productData);
                $updateData['sale_price'] = $this->getPriceFromSettings($settings['special_price_field'], $productData);
                $updateData['wholesale_price'] = $this->getPriceFromSettings($settings['wholesale_price_field'], $productData);
            }

            if ($settings['update_product_stock'] ?? 0) {
                $updateData['few'] = $productData['few'];
                $updateData['fewspd'] = $productData['fewSPD'];
                $updateData['fewtak'] = $productData['fewInBox'];
            }

            $updateData['status'] = 'inactive';
            $product->update($updateData);
        }
    }

    private function updateVariableProduct($productData, $settings)
    {
        foreach ($productData['attributeInfos'] as $attributeInfo) {
            $combination = ProductAttributeCombination::where('holo_code', $attributeInfo['productCode'] . '*' . $attributeInfo['attributeId'])->first();
            //log::info($attributeInfo['productCode'] . '-' . $attributeInfo['attributeId']);
            if ($combination) {
                $this->updateCombination($combination, $attributeInfo, $settings);
            }
        }
    }


    private function updateCombination($combination, $attributeInfo, $settings)
    {
        $updateData = [];

        // بررسی تنظیمات برای به‌روزرسانی قیمت‌ها
        if ($settings['update_product_price'] ?? 0) {
           

            $updateData['price'] = $this->getPriceFromSettings($settings['sales_price_field'], $attributeInfo);
            $updateData['sale_price'] = $this->getPriceFromSettings($settings['special_price_field'], $attributeInfo);
            $updateData['wholesale_price'] = $this->getPriceFromSettings($settings['wholesale_price_field'], $attributeInfo);
        }

        // بررسی تنظیمات برای به‌روزرسانی موجودی
        if ($settings['update_product_stock'] ?? 0) {
            $updateData['stock_quantity'] = $attributeInfo['few'] ?? 0;
        }

        // بررسی تنظیمات برای به‌روزرسانی توضیحات
        if ($settings['update_product_name'] ?? 0) {
            $updateData['description'] = $attributeInfo['comment'] ?? '';
            // بررسی تنظیمات برای به‌روزرسانی SKU
            if (!empty($attributeInfo['code2'])) {
                $updateData['sku'] = $attributeInfo['code2'];
            }
        }


        // به‌روزرسانی ترکیب
        $combination->update($updateData);
    }


    private function insertSimpleProduct($productData, $settings)
    {
        $category = $this->getCategoryByName($productData['sideGroupName']);

        $parentProduct=Product::create([
            'holo_code' => $productData['code'],
            'title' => $settings['update_product_name'] ? $productData['name'] : 'نام تعریف نشده',
            'price' => $settings['update_product_price'] ? $this->getPriceFromSettings($settings['sales_price_field'], $productData) : 0,
            'sale_price' => $settings['update_product_price'] ? $this->getPriceFromSettings($settings['special_price_field'], $productData) : 0,
            'wholesale_price' => $settings['update_product_price'] ? $this->getPriceFromSettings($settings['wholesale_price_field'], $productData) : 0,
            'few' => $settings['update_product_stock'] ? $productData['few'] : 0,
            'fewspd' => $settings['update_product_stock'] ? $productData['fewSPD'] : 0,
            'fewtak' => $settings['update_product_stock'] ? $productData['fewInBox'] : 0,
            'description' => $productData['comment'] ?? '',

            'status' => 'inactive',
        ]);
        if ($category) {
            $parentProduct->categories()->syncWithoutDetaching([$category->id]);
        }
    }


    private function insertVariableProduct($productData, $settings)
    {
        // بررسی وجود محصول
        $product = Product::where('holo_code', $productData['code'])->first();

        if (!$product) {
            // درج محصول اصلی (Parent Product)
            $product = Product::create([
                'holo_code' => $productData['code'],
                'title' => $settings['update_product_name'] ? $productData['name'] : 'نام تعریف نشده',
                'description' => $productData['comment'] ?? '',
                'type' => 'variation',
                'status' => 'inactive',
            ]);

            $category = $this->getCategoryByName($productData['sideGroupName']);
            if ($category) {
                $product->categories()->syncWithoutDetaching([$category->id]);
            }
        }

        // پردازش ترکیبات
        foreach ($productData['attributeInfos'] as $attributeInfo) {
            // استخراج نام ویژگی و خصوصیت
            $attributeName = explode('/', $attributeInfo['rootTreeParentName']); // نام ویژگی
            $propertyNames = explode('/', $attributeInfo['treeName']); // نام‌های خصوصیات از `treeName`
            //remove space after and before property

            // درج یا به‌روزرسانی ترکیب
            $combination = ProductAttributeCombination::updateOrCreate(
                ['product_id' => $product->id, 'holo_code' => $attributeInfo['productCode'] . '*' . $attributeInfo['attributeId']],
                [
                    'price' => $this->getPriceFromSettings($settings['sales_price_field'], $attributeInfo),
                    'sale_price' => $this->getPriceFromSettings($settings['special_price_field'], $attributeInfo),
                    'wholesale_price' => $this->getPriceFromSettings($settings['wholesale_price_field'], $attributeInfo),
                    'stock_quantity' => $attributeInfo['few'] ?? 0,
                    'description' => $attributeInfo['comment'] ?? '',

                    'sku' => $attributeInfo['code2'] ?? null,
                ]
            );

            foreach ($attributeName as $key => $value) {
                $attributeName[$key] = trim($value);
                $propertyNames[$key] = trim($propertyNames[$key]);

                // بررسی وجود ویژگی در دیتابیس
                $attribute = Attribute::firstOrCreate(
                    ['name' => $attributeName[$key],'independent'=> 0],
                    ['countable' => false, 'unit' => '', 'display_type' => 'options']
                );
                // بررسی وجود خصوصیت در دیتابیس
                $property = Property::firstOrCreate(
                    ['attribute_id' => $attribute->id, 'value' => $propertyNames[$key]],
                    ['description' => $propertyNames[$key]]
                );

                // اتصال خصوصیت به محصول در جدول `ProductAttributeProperty`
                ProductAttributeProperty::firstOrCreate([
                    'product_id' => $product->id,
                    'attribute_id' => $attribute->id,
                    'property_id' => $property->id,
                    'combination_id' => $combination->id,
                ]);

                AttributeProduct::firstOrCreate([
                    'product_id' => $product->id,
                    'attribute_id' => $attribute->id,
                ]);

            }




        }
    }


    private function getPriceFromSettings($priceField, $productData)
    {
        $priceFields = [
            1 => 'sellPrice',
            2 => 'sellPrice2',
            3 => 'sellPrice3',
            4 => 'sellPrice4',
            5 => 'sellPrice5',
            6 => 'sellPrice6',
            7 => 'sellPrice7',
            8 => 'sellPrice8',
            9 => 'sellPrice9',
            10 => 'sellPrice10',
        ];

        $field = $priceFields[$priceField] ?? 'sellPrice';

        return $productData[$field] ?? 0;
    }

    private function getCategoryByName($name)
    {
        // جستجوی دسته‌بندی با نام
        return Category::where('title', $name)->first();
    }

}
