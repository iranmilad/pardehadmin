<?php

namespace App\Http\Controllers\API;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\OrderItemCombination;
use App\Models\Product;
use App\Models\ProductAttributeCombination;
use App\Models\Supplier;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function update(Request $request)
    {
        $request->validate([
            'productId' => 'required|integer|exists:products,id',
            'count' => 'required|integer|min:1',
            'attributes' => 'nullable|array',
            'seller' => 'nullable|integer|exists:suppliers,id',
        ]);

        $user = Auth::user();

        // پیدا کردن آخرین سفارش در وضعیت basket
        $order = Order::firstOrCreate([
            'user_id' => $user->id,
            'status' => 'basket',
        ]);

        // دریافت محصول
        $product = Product::findOrFail($request->productId);

        // بررسی تأمین‌کننده (اگر مقدار داشت)
        $supplier = $request->seller ? Supplier::find($request->seller) : null;

        if ($request->has('attributes') && !empty($request->attributes)) {
            // پیدا کردن ترکیب محصول بر اساس ویژگی‌ها
            $combination = ProductAttributeCombination::where('product_id', $product->id)
                ->whereHas('attributeProperties', function ($query) use ($request) {
                    foreach ($request->attributes as $attributeId => $propertyId) {
                        $query->where('attribute_id', $attributeId)->where('property_id', $propertyId);
                    }
                })
                ->first();

            if (!$combination) {
                return response()->json(['message' => 'ترکیب محصول یافت نشد'], 404);
            }

            // اضافه کردن آیتم با ترکیب محصول
            $orderItem = OrderItem::create([
                'id' => rand(1111111,9999999),
                'order_id' => $order->id,
                'product_id' => $product->id,
                'quantity' => $request->count,
                'price' => $combination->price,
                'sale_price' => $combination->sale_price,
                'total' => $request->count * ($combination->sale_price ?? $combination->price),
                'status' => 'waiting',
                'supplier_id' => $supplier ? $supplier->id : null,
            ]);

            // ثبت ترکیب محصول در جدول میانی
            OrderItemCombination::create([
                'order_item_id' => $orderItem->id,
                'combination_id' => $combination->id,
            ]);
        } else {
            // اضافه کردن آیتم ساده (بدون ترکیب)
            $orderItem = OrderItem::create([
                'id' => rand(1111111,9999999),
                'order_id' => $order->id,
                'product_id' => $product->id,
                'quantity' => $request->count,
                'price' => $product->price,
                'sale_price' => $product->sale_price,
                'total' => $request->count * ($product->sale_price ?? $product->price),
                'status' => 'waiting',
                'supplier_id' => $supplier ? $supplier->id : null,
            ]);
        }
        $cartItems = [];
    
        foreach ($order->basket()->items as $item) {
            $attributes = [];
            
            // استخراج ویژگیها از ترکیبات محصول
  
            $cartItems[] = [
                'productId' => $item->product_id,
                'attributes' => $item->combinations->id ?? null,
                'seller' => $item->supplier->id ?? null,
                'count' => $item->quantity,
            ];
        }
    
        // ساخت پاسخ نهایی
        return response()->json([
            'message' => 'ok',
            'cart' => $cartItems
        ]);
    }
}
