<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;

class CompareController extends Controller
{
    public function compare(Request $request)
    {
        $productIds = json_decode($request->input('id'), true);

        if (!is_array($productIds) || count($productIds) !== 2) {
            return response()->json([
                'message' => 'لطفاً دقیقا دو محصول را برای مقایسه ارسال کنید.',
            ], 400);
        }

        $products = Product::whereIn('id', $productIds)->get();

        if ($products->count() !== 2) {
            return response()->json([
                'message' => 'برخی از محصولات یافت نشدند.',
            ], 404);
        }

        // پردازش اطلاعات محصولات
        $data = [
            'title' => $products->pluck('title')->toArray(),
            'slug' => $products->pluck('id')->toArray(),
            'image' => $products->map(fn($product) => asset($product->img))->toArray(),
            'rating' => $products->map(fn($product) => $product->rating ?? '0')->toArray(),
            'price' => $products->map(fn($product) => [
                'regularPrice' => $product->price,
                'discountedPrice' => $product->sale_price ?? null
            ])->toArray(),
            'attributes' => $this->formatAttributes($products)
        ];

        return response()->json([
            'message' => 'ok',
            'data' => $data
        ]);
    }

    private function formatAttributes($products)
    {
        $attributeGroups = [];

        foreach ($products as $product) {
            foreach ($product->attributes as $attribute) {
                $label = $attribute->name;
                $properties = $attribute->properties->pluck('value')->toArray();

                if (!isset($attributeGroups[$label])) {
                    $attributeGroups[$label] = [
                        'label' => $label,
                        'value' => []
                    ];
                }

                // بررسی مقدار property برای هر محصول
                $attributeGroups[$label]['value'][] = count($properties) ? implode('، ', $properties) : '-';
            }
        }

        return array_values($attributeGroups);
    }

}
