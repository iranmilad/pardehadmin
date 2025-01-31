<?php

namespace App\Http\Controllers\API;

use App\Models\Product;
use App\Models\Category;
use App\Models\Brand; // افزودن مدل برند
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class FastOrderController extends Controller
{
    public function getFastOrderProducts(Request $request)
    {
        $query = Product::query();


        if ($request->searchType === 'category') {

        
            // اگر زیرمجموعه (subcategory) ست شده باشد، فیلتر بر اساس زیرمجموعه
            if ($request->subCategory) {
                $query->whereHas('categories', function ($q) use ($request) {
                    $q->whereIn('categories.id', $request->subCategory);  // استفاده از categories.id
                });
            } elseif ($request->parent) {
                // اگر زیرمجموعه ست نشده و parent ست شده باشد، فیلتر بر اساس دسته‌بندی‌های اصلی
                $query->whereHas('categories', function ($q) use ($request) {
                    $q->whereNull('parent_id')  // دسته‌بندی‌هایی که parent ندارند
                       ->whereIn('categories.id', $request->parent);  // استفاده از categories.id
                });
            }
            // اگر برند ست شده باشد، فیلتر برندها
            if ($request->brands) {
                $query->whereIn('brand_id', $request->brands);
            }
        }
        else{
            // اگر برند ست شده باشد، فیلتر برندها
            if ($request->brands) {
                $query->whereIn('brand_id', $request->brands);
            }

            // اگر زیرمجموعه (subcategory) ست شده باشد، فیلتر بر اساس زیرمجموعه
            if ($request->subCategory) {
                $query->whereHas('categories', function ($q) use ($request) {
                    $q->whereIn('categories.id', $request->subCategory);  // استفاده از categories.id
                });
            } elseif ($request->parent) {
                // اگر زیرمجموعه ست نشده و parent ست شده باشد، فیلتر بر اساس دسته‌بندی‌های اصلی
                $query->whereHas('categories', function ($q) use ($request) {
                    $q->whereNull('parent_id')  // دسته‌بندی‌هایی که parent ندارند
                        ->whereIn('categories.id', $request->parent);  // استفاده از categories.id
                });
            }

            
        }
        

        // فیلترهای اضافی
        if ($request->filters) {
            $filters = $request->filters;

            if (!empty($filters['province'])) {
                $areas = explode(',', $filters['province']); // تبدیل رشته به آرایه از نواحی
                
                // جستجو در فیلد delivery_areas برای هر تامین‌کننده
                $query->whereHas('suppliers', function ($q) use ($areas) {
                    $q->where(function($q) use ($areas) {
                        foreach ($areas as $area) {
                            // جستجو برای وجود ناحیه در رشته delivery_areas
                            $q->orWhere('delivery_areas', 'like', '%' . trim($area) . '%');
                        }
                    });
                });
            }

            if (!empty($filters['stockStatus'])) {
                $query->where('stock_status', $filters['stockStatus']);
            }

            if (!empty($filters['minStock'])) {
                $query->where('stock', '>=', $filters['minStock']);
            }

            if (!empty($filters['deliveryTime'])) {
                $query->where('delivery_time', '<=', $filters['deliveryTime']);
            }

            if (!empty($filters['paymentType'])) {
                $query->where('payment_type', $filters['paymentType']);
            }

            if (!empty($filters['supplier'])) {
                $query->where('supplier_id', $filters['supplier']);
            }
        }

        // مرتب‌سازی
        if (!empty($request->filters['sort'])) {

            switch ($request->filters['sort']) {
                case 'lowest_price':
                    $query->orderBy('price', 'asc');
                    break;
                case 'max_inventory':
                    $query->orderBy('price', 'desc');
                    break;
                case 'newer':
                default:
                    $query->orderBy('created_at', 'desc');
                    break;
            }

        }

        // صفحه‌بندی
        $pageSize = $request->input('pageSize', 20);
        $page = $request->input('page', 1);
        $products = $query->paginate($pageSize, ['*'], 'page', $page);

        // دریافت دسته‌بندی‌های اصلی و زیرمجموعه‌ها
        $categories = Category::whereNull('parent_id')->get(['id', 'title']);
        $subCategories = Category::whereNotNull('parent_id')->get(['id', 'title']);

        $productList = $products->map(function ($product) use ($request) {
            // مرتب‌سازی `nodes` با توجه به نوع sort
            $sortedNodes = $product->suppliers->sortBy(function ($supplier) use ($request) {
                switch ($request->filters['sort']) {
                    case 'lowest_price':
                        return $supplier->price;
                    case 'max_inventory':
                        return -$supplier->few; // منفی کردن برای ترتیب نزولی
                    case 'min_deliveryTime':
                        return $supplier->delivery_time ?? now(); // فرض بر این است که `delivery_time` یک مقدار معتبر است
                    default:
                        return $supplier->created_at ?? now();
                }
            });
        
            // انتخاب بهترین `node` به عنوان پیش‌فرض
            $defaultNode = $sortedNodes->first();  // اولین node بعد از مرتب‌سازی به عنوان پیش‌فرض در نظر گرفته می‌شود
        
            return [
                'id' => (string) $product->id,
                'image' => $product->img ?? '',
                'name' => $product->title,
                'price' => (string) $product->price,
                'stock' => (string) $product->stock,
                'minOrder' => (string) $product->min_order ?? '1',
                'seller' => [
                    'id' => (string) ($defaultNode->id ?? 1),
                    'label' => $defaultNode->name ?? 'نامشخص',
                ],
                'deliveryTime' => (string) $product->delivery_time ?? 'نامشخص',
                'action' => 3,
                'nodes' => $product->suppliers->map(function ($supplier) use ($product, $defaultNode) {
                    return [
                        'id' => "{$product->id}-{$supplier->id}",
                        'image' => '',
                        'name' => $supplier->name ?? '',
                        'price' => (string) $supplier->price,
                        'stock' => (string) $supplier->few,
                        'minOrder' => (string) $supplier->min_order ?? '1',
                        'maxOrder' => (string) $supplier->max_order ?? null,
                        'seller' => [
                            'id' => (string) $supplier->id,
                            'label' => $supplier->name ?? 'نامشخص',
                        ],
                        'deliveryTime' => (string) $product->delivery_time ?? 'نامشخص',
                        'action' => 3,
                        'isDefault' => $supplier->id === $defaultNode->id, // تنظیم پیش‌فرض برای تامین‌کننده
                        'nodes' => null,
                    ];
                }),
            ];
        });
        
        

        // برندها: گرفتن تمامی برندها از دیتابیس و تبدیل آن‌ها به فرمت مورد نیاز
        $brands = Brand::all()->map(function ($brand) {
            return [
                'id' => (string) $brand->id,
                'title' => $brand->title,
                'image' => $brand->image ?? '',
            ];
        });

        return response()->json([
            'totalItems' => $products->total(),
            'category' => $categories,
            'products' => $productList,
            'subCategory' => $subCategories,
            'brands' => $brands,
        ]);
    }
}
