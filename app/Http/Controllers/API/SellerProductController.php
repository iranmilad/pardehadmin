<?php
namespace App\Http\Controllers\API;


use App\Models\Supplier;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Product;


class SellerProductController extends Controller
{
    public function getSellerProducts($id, Request $request)
    {
        // دریافت تامین‌کننده
        $supplier = Supplier::findOrFail($id);

        // دریافت فیلترهای ورودی
        $priceMin = $request->input('price_min', 0);
        $priceMax = $request->input('price_max', PHP_INT_MAX);
        $limit = $request->input('limit', 20);
        $page = $request->input('page', 1);
        $sort = $request->input('sort', 'newest');
        $search = $request->input('s', '');

        $query = Product::whereHas('productSuppliers', function ($q) use ($supplier) {
            $q->where('supplier_id', $supplier->id);
        })
        ->whereBetween('price', [$priceMin, $priceMax]); // حذف `products.` چون `whereBetween` در `Product` اجرا می‌شود
    
        if ($search) {
            $query->where('title', 'like', "%{$search}%");
        }
        
        // اعمال مرتب‌سازی روی Query Builder
        switch ($sort) {
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
        
        // دریافت داده‌ها پس از اعمال همه فیلترها
        $products = $query->paginate($limit, ['*'], 'page', $page);
        
        // فرمت کردن خروجی محصولات
        $productData = $products->map(function ($product) {
            return [
                'id' => $product->id,
                'title' => $product->title,
                'slug' => (string) $product->id,
                'regularPrice' => $product->price,
                'discountedPrice' => $product->sale_price ?? null,
                'discountPercent' => $product->discount_percent ?? null,
                'image' => $product->img ?? '',
            ];
        });
        
        // خروجی نهایی
        return response()->json([
            'message' => 'ok',
            'data' => [
                'totalPages' => $products->lastPage(),
                'price' => [
                    'min' => $priceMin,
                    'max' => $priceMax,
                ],
                'products' => $productData,
                'filters' => $this->getFilters(),
            ]
        ]);
    
    }

    // دریافت فیلترها (نمونه)
    private function getFilters()
    {
        return [
            [
                'title' => 'برندها',
                'key' => 'brands',
                'options' => [
                    ['label' => 'اپل', 'value' => 'apple'],
                    ['label' => 'سامسونگ', 'value' => 'samsung'],
                    ['label' => 'ایسوس', 'value' => 'asus'],
                    ['label' => 'بیتس', 'value' => 'beats'],
                    ['label' => 'ال جی', 'value' => 'lg'],
                ]
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
                ]
            ],
            [
                'title' => 'محدوده ارسال',
                'key' => 'delivery_areas',
                'options' => [
                    ['label' => 'تهران', 'value' => 'tehran'],
                    ['label' => 'کرج', 'value' => 'karaj'],
                    ['label' => 'فارس', 'value' => 'fars'],
                ]
            ]
        ];
    }
}
