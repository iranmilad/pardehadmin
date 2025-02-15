<?php
namespace App\Http\Controllers\API;

use Carbon\Carbon;
use App\Models\Product;
use Illuminate\Http\Request;
use Morilog\Jalali\Jalalian;
use App\Http\Controllers\Controller;

class ProductController extends Controller
{
    public function show($id)
    {
        $product = Product::with([
            'images',
            'attributes.properties',
            'attributeCombinations.attributeProperties.property',
            'attributeCombinations.suppliers.user',
            'attributeCombinations.suppliers.reviews.user',
            'priceHistories',
            'suppliers.reviews.user',
        ])->findOrFail($id);

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

        // اگر محصول دارای متغیر نباشد، تامین‌کنندگان مستقیم برگردانده شوند
        if ($product->attributeCombinations->isEmpty()) {
            $suppliers = $product->suppliers->map(function ($supplier) {
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
                    "special_offer" => $supplier->is_special && !empty($supplier->special_time)
                        ? Jalalian::fromCarbon(Carbon::parse($supplier->special_time))->format('Y-m-d')
                        : null,
                    'reviews_count' => $reviews->count(),
                    'reviews' => $reviews->toArray(),
                ];
            });

            return response()->json([
                'id' => $product->id,
                'type' => 'simple',
                'stock_status' => $product->few > 0 ? 'instock' : 'outofstock',
                'general' => $general,
                'suppliers' => $suppliers,
            ]);
        }

        // اگر محصول دارای ترکیب‌ها باشد، اطلاعات همانند قبل برگردانده شود
        $options = $product->attributes->map(function ($option) {
            return [
                'id' => $option->id,
                'label' => $option->name,
                'slug' => $option->display_type,
                'type' => $option->display_type,
                'children' => $option->properties->map(function ($child) {
                    return [
                        'id' => $child->id,
                        'label' => $child->description,
                        'value' => $child->value,
                    ];
                })->toArray(),
            ];
        });

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
                    "special_offer" => $supplier->is_special && !empty($supplier->special_time)
                        ? Jalalian::fromCarbon(Carbon::parse($supplier->special_time))->format('Y-m-d')
                        : null,

                    'rating' => $supplier->rating,
                    'reviews_count' => $reviews->count(),
                    'reviews' => $reviews->toArray(),
                ];
            });

            return [
                'id' => $combination->id,
                'options' => $combination->selectedProperties(),
                'suppliers' => $suppliers->toArray(),
            ];
        });

        return response()->json([
            'id' => $product->id,
            'type' => 'variable',
            'stock_status' => $product->few > 0 ? 'instock' : 'outofstock',
            'general' => $general,
            'options' => $options,
            'combinations' => $combinations,
        ]);
    }
}
