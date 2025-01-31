<?php

namespace App\Http\Controllers\API;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ShopController extends Controller
{
    public function getProducts(Request $request)
    {
        $query = Product::query();

        // فیلتر قیمت
        if ($request->has('price_min')) {
            $query->where('price', '>=', $request->price_min);
        }
        if ($request->has('price_max')) {
            $query->where('price', '<=', $request->price_max);
        }

        // فیلتر جستجو بر اساس عنوان
        if ($request->has('s')) {
            $query->where('title', 'LIKE', '%' . $request->s . '%');
        }

        switch ($request->sort) {
            case 'lowest_price':
                $query->orderBy('price', 'asc');
                break;
            case 'highest_price':
                $query->orderBy('price', 'desc');
                break;
            case 'newest':
            default:
                $query->orderBy('created_at', 'desc');
                break;
        }
        
        // صفحه‌بندی
        $limit = $request->input('limit', 20);
        $page = $request->input('page', 1);
        $products = $query->paginate($limit, ['*'], 'page', $page);

        // دریافت محدوده قیمت
        $minPrice = Product::min('price');
        $maxPrice = Product::max('price');

        // تبدیل داده‌های محصول به فرمت موردنظر
        $productList = $products->map(function ($product) {
            return [
                'id' => $product->id,
                'title' => $product->title,
                'slug' => (string) $product->id,
                'regularPrice' => $product->price,
                'discountedPrice' => $product->sale_price ?? null,
                'discountPercent' => $product->discount_percentage ? (string) $product->discount_percentage : null,
                'image' => $product->image_url ?? '/default/image.jpg',
            ];
        });

        // فیلترهای نمونه (برندها، رنگ‌ها، محدوده ارسال)
        $filters = [
            [
                'title' => 'برندها',
                'key' => 'brands',
                'options' => [
                    ['label' => 'اپل', 'value' => 'apple'],
                    ['label' => 'سامسونگ', 'value' => 'samsung'],
                    ['label' => 'ایسوس', 'value' => 'asus'],
                    ['label' => 'بیتس', 'value' => 'beats'],
                    ['label' => 'ال جی', 'value' => 'lg'],
                ],
            ],
            [
                'title' => 'رنگ‌ها',
                'key' => 'colors',
                'options' => [
                    ['label' => 'قرمز', 'value' => 'red'],
                    ['label' => 'آبی', 'value' => 'blue'],
                    ['label' => 'سبز', 'value' => 'green'],
                    ['label' => 'مشکی', 'value' => 'black'],
                    ['label' => 'سفید', 'value' => 'white'],
                ],
            ],
            [
                'title' => 'محدوده ارسال',
                'key' => 'delivery_areas',
                'options' => [
                    ['label' => 'تهران', 'value' => 'tehran'],
                    ['label' => 'کرج', 'value' => 'karaj'],
                    ['label' => 'فارس', 'value' => 'fars'],
                ],
            ],
        ];

        // خروجی نهایی
        return response()->json([
            'message' => 'ok',
            'data' => [
                'totalPages' => $products->lastPage(),
                'price' => [
                    'min' => $minPrice,
                    'max' => $maxPrice,
                ],
                'products' => $productList,
                'filters' => $filters,
            ],
        ]);
    }
}
