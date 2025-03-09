<?php
namespace App\Jobs;

use Throwable;
use App\Models\Product;
use App\Models\Setting;
use App\Models\Category;
use App\Models\Property;
use App\Models\Attribute;
use Illuminate\Bus\Queueable;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Http;
use Illuminate\Queue\SerializesModels;
use App\Models\ProductAttributeProperty;
use Illuminate\Queue\InteractsWithQueue;
use App\Models\ProductAttributeCombination;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class ProcessProductPage implements ShouldQueue
{
    use Dispatchable, Queueable, InteractsWithQueue, SerializesModels;

    protected $url;
    protected $serial;
    protected $token;
    protected $page;
    public $timeout = 60;
    public $tries = 1;

    public function __construct($url, $serial, $token, $page)
    {
        $this->url = $url;
        $this->serial = $serial;
        $this->token = $token;
        $this->page = $page;
    }


    public function handle()
    {
        try {
            $response = Http::timeout($this->timeout)
                ->withoutVerifying()
                ->withHeaders([
                    'serial' => $this->serial,
                    'Accept' => 'text/plain',
                    'Token' => $this->token,
                    'isResponseOnWebhook' => 'false',
                ])->get($this->url . '?page=' . $this->page . '&itemsPerPage=100&getAttributes=true');

            if ($response->successful() && $response->json('Data.isSuccess')) {
                $products = $response->json('Data.content.list', []);
                foreach ($products as $product) {
                    if (!empty($product['attributeInfos'])) {
                        $this->storeVariableProduct($product);
                    } else {
                        $this->storeSimpleProduct($product);
                    }
                }
            }
        } catch (Throwable $e) {
            Log::error('Job Failed: ' . $e->getMessage());
            $this->fail($e); // اگر Job خطا دهد، Fail می‌شود
        }
    }

    private function storeSimpleProduct($product)
    {
        $settings = $this->getUserSettings();

        // پیدا کردن کد دسته‌بندی
        $category = $this->getCategoryByName($product['sideGroupName']);

        // ذخیره یا به‌روزرسانی محصول
        $savedProduct = Product::updateOrCreate(
            ['holo_code' => $product['code']],
            [
                'title' => $product['name'],
                'price' => $this->getPriceFromSettings($settings['sales_price_field'], $product),
                'sale_price' => $this->getPriceFromSettings($settings['special_price_field'], $product),
                'wholesale_price' => $this->getPriceFromSettings($settings['wholesale_price_field'], $product),
                'few' => $product['few'],
                'fewspd' => $product['fewSPD'],
                'fewtak' => $product['fewInBox'],
                'description' => $product['comment'],
                'status' => 'inactive',
            ]
        );

        // اتصال دسته‌بندی به محصول
        if ($category) {
            $savedProduct->categories()->syncWithoutDetaching([$category->id]);
        }
    }

    private function storeVariableProduct($product)
    {
        $settings = $this->getUserSettings();

        // پیدا کردن کد دسته‌بندی
        $category = $this->getCategoryByName($product['sideGroupName']);

        $parentProduct = Product::updateOrCreate(
            ['holo_code' => $product['code']],
            [
                'title' => $product['name'],
                'description' => $product['comment'],
                'status' => 'inactive',
                'type' => 'variation',
            ]
        );
        // اتصال دسته‌بندی به محصول
        if ($category) {

            $parentProduct->categories()->syncWithoutDetaching([$category->id]);
        }

        foreach ($product['attributeInfos'] as $attributeInfo) {
            $attributeNames = explode('/', $attributeInfo['rootTreeParentName']);
            $propertyNames = explode('/', $attributeInfo['treeName']);

            $combination = ProductAttributeCombination::updateOrCreate(
                [
                    'product_id' => $parentProduct->id,
                    'holo_code' => $attributeInfo['productCode'] . '-' . $attributeInfo['attributeId'],
                ],
                [
                    'price' => $this->getPriceFromSettings($settings['sales_price_field'], $attributeInfo),
                    'sale_price' => $this->getPriceFromSettings($settings['special_price_field'], $attributeInfo),
                    'wholesale_price' => $this->getPriceFromSettings($settings['wholesale_price_field'], $attributeInfo),
                    'stock_quantity' => $attributeInfo['few'] ?? 0,
                    'description' => $attributeInfo['comment'] ?? '',
                    'sku' => $attributeInfo['code2'] ?? null,
                ]
            );

            foreach ($attributeNames as $key => $attributeName) {
                $attribute = Attribute::firstOrCreate(
                    ['name' => trim($attributeName)],
                    ['independent' => false]
                );

                $property = Property::firstOrCreate(
                    ['attribute_id' => $attribute->id, 'value' => trim($propertyNames[$key])],
                    ['description' => trim($propertyNames[$key])]
                );

                ProductAttributeProperty::updateOrCreate(
                    [
                        'product_id' => $parentProduct->id,
                        'attribute_id' => $attribute->id,
                        'property_id' => $property->id,
                        'combination_id' => $combination->id,
                    ]
                );
            }
        }
    }

    private function getCategoryByName($name)
    {
        // جستجوی دسته‌بندی با نام
        return Category::where('title', $name)->first();
    }

    private function getUserSettings()
    {
        // Retrieve the settings from your database
        $setting = Setting::where('group', 'holo')->where('section', 'holo')->first();
        return $setting ? $setting->settings : null;
    }

    private function getPriceFromSettings($priceField, $product)
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

        return $product[$priceFields[$priceField] ?? 'sellPrice'] ?? 0;
    }
}
