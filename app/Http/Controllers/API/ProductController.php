<?php
namespace App\Http\Controllers\API;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProductController extends Controller
{
    public function show($id)
    {
        // دریافت محصول همراه با روابط مورد نیاز
        $product = Product::with([
            'images',
            'attributes.properties',
            'attributeCombinations.attributeProperties.property',
            'attributeCombinations.suppliers.user', // بارگذاری کاربر برای تأمین‌کننده
            'attributeCombinations.suppliers.reviews.user', // بارگذاری نظرات تأمین‌کننده
            'priceHistories' // بارگذاری تاریخچه قیمت
        ])->findOrFail($id);

        // اطلاعات کلی محصول
        $general = [
            'slug' => $product->slug,
            'title' => $product->title,
            'english_title' => $product->english_title,
            'addedToFavorite' => $product->added_to_favorite,
            'images' => $product->images->pluck('url')->toArray(),
            'description' => $product->description,
            'specifications' => $product->specifications,
            'priceHistory' => $product->priceHistories->map(function ($history) {
                return [
                    'date' => $history->date,
                    'minPrice' => $history->min_price,
                    'maxPrice' => $history->max_price,
                ];
            }),
        ];

        // ویژگی‌های محصول
        $options = $product->attributes->map(function ($option) {
            return [
                'id' => $option->id,
                'label' => $option->name,
                'slug' => $option->display_type,
                'children' => $option->properties->map(function ($child) {
                    return [
                        'id' => $child->id,
                        'label' => $child->description,
                        'value' => $child->value,
                    ];
                })->toArray(),
            ];
        });

        // ترکیب‌های محصول
        $combinations = $product->attributeCombinations->map(function ($combination) use ($product) {
            $suppliers = $combination->suppliers->map(function ($supplier) {
                $reviews = $supplier->reviews->map(function ($review) {
                    return [
                        'id' => $review->id,
                        'user' => $review->user->name,
                        'comment' => $review->text,
                        'rating' => $review->rating,
                        'date' => $review->created_at->format('Y-m-d'),
                    ];
                });

                return [
                    'id' => $supplier->id,
                    'name' => $supplier->name,
                    'payment_type' => $supplier->payment_type,
                    'delivery' => $supplier->delivery_areas,
                    'buy_type' => $supplier->buy_type,
                    'price' => [
                        'regularPrice' => $supplier->price ?? 0,
                        'discountedPrice' => $supplier->sale_price ?? 0,
                        'discountPercent' => $supplier->discount_percent ?? null,
                    ],
                    'sku' => $supplier->sku,
                    'inventory' => $supplier->few,
                    'min_order' => $supplier->min_order,
                    'max_order' => $supplier->max_order,
                    'rating' => $supplier->rating,
                    'reviews_count' => $reviews->count(),
                    'reviews' => $reviews->toArray(),
                ];
            });

            if ($suppliers->isEmpty()) {
                $suppliers = collect([
                    [
                        'id' => null,
                        'name' => 'نامشخص',
                        'payment_type' => 'نامشخص',
                        'delivery' => 'نامشخص',
                        'buy_type' => 'نامشخص',
                        'price' => [
                            'regularPrice' => $product->price ?? 0,
                            'discountedPrice' => $product->sale_price ?? 0,
                            'discountPercent' => $product->discount_percent ?? 0,
                        ],
                        'sku' => $product->sku ?? 'نامشخص',
                        'inventory' => $product->few ?? 0,
                        'min_order' => 1,
                        'max_order' => $product->inventory ?? 1,
                        'rating' => 0,
                        'reviews_count' => 0,
                        'reviews' => [],
                    ]
                ]);
            }

            return [
                'id' => $combination->id,
                'options' => $combination->selectedProperties(),
                'suppliers' => $suppliers->toArray(),
            ];
        });

        return response()->json([
            'id' => $product->id,
            'general' => $general,
            'options' => $options,
            'combinations' => $combinations,
        ]);
    }
}
