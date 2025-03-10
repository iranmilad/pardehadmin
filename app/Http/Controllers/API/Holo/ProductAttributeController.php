<?php

namespace App\Http\Controllers\API\Holo;

use App\Models\Attribute;
use App\Models\Property;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;

class ProductAttributeController extends Controller
{
    public function fetchAndStoreAttributes(Request $request)
    {
        // دریافت تنظیمات کاربر
        $settings = $this->getUserSettings();
        if (!$settings) {
            return response()->json(['message' => 'User settings not configured'], 500);
        }

        // اطمینان از وجود توکن معتبر
        $token = $this->ensureToken($settings);

        // دریافت ویژگی‌ها و خصوصیات
        $attributesData = $this->getAttributesFromHolo($settings["serial"], $token);

        if (!$attributesData['success']) {
            return response()->json(['message' => 'Failed to fetch attributes', 'error' => $attributesData['error']], 500);
        }

        // ذخیره ویژگی‌ها و خصوصیات در دیتابیس
        $this->storeAttributesAndProperties($attributesData['attributes']);

        return response()->json(['message' => 'Attributes and properties stored successfully'], 200);
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

    private function getAttributesFromHolo($serial, $token)
    {
        $url = 'http://apigw.holoo.cloud/api/Product/GetProductAttributes';
        $headers = [
            'serial: ' . $serial,
            'Accept: text/plain',
            'Token: ' . $token,
            'isResponseOnWebhook: false',
        ];

        $response = $this->sendCurlRequest($url, 'GET', [], $headers);

        if ($response['Data']['isSuccess'] ?? false) {
            return ['success' => true, 'attributes' => $response['Data']['content']['list']];
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

    private function storeAttributesAndProperties($attributes)
    {
        foreach ($attributes as $attributeData) {

            if ($attributeData['parentId'] === 0) {
                // ذخیره ویژگی اصلی
                $attribute = Attribute::firstOrCreate(
                    ['name' => trim($attributeData['name']), 'independent' => 0],
                    ['countable' => false, 'unit' => '', 'display_type' => 'options']
                );
            } else {
                $attribute =  explode('/',$attributeData['treeName'])[0];
                // پیدا کردن ویژگی والد
                $parentAttribute = Attribute::where('name', trim($attribute))->first();

                if ($parentAttribute) {
                    // ذخیره خصوصیت
                    Property::firstOrCreate(
                        ['attribute_id' => $parentAttribute->id, 'value' => trim($attributeData['name'])],
                        ['description' => trim($attributeData['name'])]
                    );
                }
            }
        }
    }
}
