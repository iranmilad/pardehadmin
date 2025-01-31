<?php

namespace App\Jobs;

use App\Models\Product;
use App\Models\ProductAttributeCombination;
use Illuminate\Bus\Queueable;
use Illuminate\Support\Facades\Http;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class UpdateSingleProductPage implements ShouldQueue
{
    use Dispatchable, Queueable, InteractsWithQueue, SerializesModels;

    protected $url;
    protected $serial;
    protected $token;
    protected $page;
    protected $settings;

    public function __construct($url, $serial, $token, $page, $settings)
    {
        $this->url = $url;
        $this->serial = $serial;
        $this->token = $token;
        $this->page = $page;
        $this->settings = $settings;
    }

    public function handle()
    {
        $response = Http::withoutVerifying()->withHeaders([
            'serial' => $this->serial,
            'Accept' => 'text/plain',
            'Token' => $this->token,
            'isResponseOnWebhook' => 'false',
        ])->get($this->url . '?page=' . $this->page . '&itemsPerPage=100&getAttributes=true');

        if ($response->successful() && $response->json('Data.isSuccess')) {
            $productDatas = $response->json('Data.content.list', []);
            foreach ($productDatas as $productData) {
                if (!empty($productData['attributeInfos'])) {
                    $this->updateVariableProduct($productData, $this->settings);
                } else {
                    $this->updateSimpleProduct($productData, $this->settings);
                }
            }
        }
    }

    private function updateSimpleProduct($productData, $settings)
    {
        $product = Product::where('holo_code', $productData['code'])->first();

        if ($product) {
            $updateData = [];

            if ($settings['update_product_name'] ?? false) {
                $updateData['title'] = $productData['name'];
                $updateData['description'] = $productData['comment'] ?? '';
            }

            if ($settings['update_product_price'] ?? false) {
                $updateData['price'] = $this->getPriceFromSettings($settings['sales_price_field'], $productData);
                $updateData['sale_price'] = $this->getPriceFromSettings($settings['special_price_field'], $productData);
                $updateData['wholesale_price'] = $this->getPriceFromSettings($settings['wholesale_price_field'], $productData);
            }

            if ($settings['update_product_stock'] ?? false) {
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
        $parentProduct = Product::where('holo_code', $productData['code'])->first();

        if (!$parentProduct) {
            $parentProduct = Product::create([
                'holo_code' => $productData['code'],
                'title' => $settings['update_product_name'] ? $productData['name'] : 'نام تعریف نشده',
                'description' => $productData['comment'] ?? '',
                'type' => 'variation',
                'status' => 'inactive',
            ]);
        }

        foreach ($productData['attributeInfos'] as $attributeInfo) {
            $combination = ProductAttributeCombination::updateOrCreate(
                ['holo_code' => $attributeInfo['productCode'] . '-' . $attributeInfo['attributeId']],
                [
                    'product_id' => $parentProduct->id,
                    'price' => $this->getPriceFromSettings($settings['sales_price_field'], $attributeInfo),
                    'sale_price' => $this->getPriceFromSettings($settings['special_price_field'], $attributeInfo),
                    'stock_quantity' => $settings['update_product_stock'] ? ($attributeInfo['few'] ?? 0) : null,
                    'sku' => $attributeInfo['code2'] ?? '',
                ]
            );
        }
    }

    private function getPriceFromSettings($priceField, $productData)
    {
        $priceMapping = [
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

        $field = $priceMapping[$priceField] ?? 'sellPrice';
        return $productData[$field] ?? 0;
    }
}
