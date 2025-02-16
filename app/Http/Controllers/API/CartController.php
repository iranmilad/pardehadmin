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

    public function index()
    {
        $user = Auth::user();

        // دریافت سفارش در وضعیت 'basket'
        $order = Order::where('user_id', $user->id)
            ->where('status', 'basket')
            ->first();

        if (!$order) {
            return response()->json([
                'message' => 'سبد خرید شما خالی است',
                'cart' => []
            ]);
        }

        $cartItems = [];
        $items = $order->basket()->items;

        foreach ($items as $item) {
            $options=[];
            foreach($item->options as $key=>$value){
                $options[]= array_values($value)[0];
            }

            $cartItems[] = [
                "id" => $item->id,
                'productId' => $item->product_id,
                'name' => $item->name,
                'image' => $item->img,
                'attributes' =>$options,
                'combinationsID' => $item->combination,
                'seller' => ($item->supplier!=null) ? $item->supplier : null,
                'count' => $item->quantity,
                'price' => [
                    "regularPrice" => $item->price,
                    "discountedPrice" => $item->sale_price,
                    "discountPercent" => $item->discountPercentage,
                ]
            ];
        }

        return response()->json([
            'message' => 'ok',
            'cart' => $cartItems
        ]);
    }

    public function cartInfo(){
        $user = Auth::user();

        // دریافت سفارش در وضعیت 'basket'
        $order = Order::where('user_id', $user->id)
            ->where('status', 'basket')
            ->first();

        if (!$order) {
            return response()->json([
                'message' => 'اطلاعات تماس خالی است',
                'cartinfo' => []
            ]);
        }

        $cartInfo =[
            "is_self_delivery" =>(bool) $order->is_self_delivery,
            "user_info" =>[
                'user_name' => $user->first_name . ' ' . $user->last_name,
                'user_mobile' => $user->mobile,
                'user_email' => $user->email,
                'user_country' => $user->country,
                'user_province' => $user->province,
                'user_address' => $user->address,
                'user_postal_code' => $user->postal_code,
                'user_phone' => $user->phone,
                'user_national_code' => $user->national_code,
            ],
            "delivery_location" =>[
                'customer_name' => $order->customer_name,
                'customer_email' => $order->customer_email,
                'customer_phone_number' => $order->customer_phone_number,
                'shipping_country' => $order->shipping_country,
                'shipping_province' => $order->shipping_province,
                'shipping_city' => $order->shipping_city,
                'shipping_address' => $order->shipping_address,
                'shipping_postal_code' => $order->shipping_postal_code,
                'shipping_phone' => $order->shipping_phone,
                'shipping_note' => $order->shipping_note,

            ]
        ];

        return response()->json([
            'message' => 'ok',
            'cartinfo' => $cartInfo
        ]);
    }

    public function cartRemove(Request $request)
    {
        $request->validate([
            'productId' => 'required|integer',
            'combinationsID' => 'nullable|integer',
            'sellerId' => 'nullable|integer',
        ]);

        $user = Auth::user();

        // دریافت سفارش در وضعیت 'basket'
        $order = Order::where('user_id', $user->id)
            ->where('status', 'basket')
            ->first();

        if (!$order) {
            return response()->json([
                'message' => 'سبد خرید شما خالی است',
            ], 404);
        }

        // بررسی وجود محصول
        $product = Product::find($request->productId);
        if (!$product) {
            return response()->json([
                'message' => 'آیتم مورد نظر یافت نشد',
            ], 404);
        }

        // بررسی وجود فروشنده (در صورت ارسال)
        $supplier = null;
        if ($request->filled('sellerId')) {
            $supplier = Supplier::find($request->sellerId);
            if (!$supplier) {
                return response()->json([
                    'message' => 'آیتم مورد نظر یافت نشد',
                ], 404);
            }
        }

        // پیدا کردن آیتم در سبد خرید
        $orderItemQuery = OrderItem::where('order_id', $order->id)
            ->where('product_id', $product->id);

        if ($supplier) {
            $orderItemQuery->where('supplier_id', $supplier->id);
        }

        $orderItem = $orderItemQuery->first();
        if (!$orderItem) {
            return response()->json([
                'message' => 'آیتم مورد نظر یافت نشد',
            ], 404);
        }

        // بررسی ترکیب محصول (در صورت ارسال)
        if ($request->filled('combinationsID')) {
            $combination = OrderItemCombination::where('order_item_id', $orderItem->id)
                ->where('combination_id', $request->combinationsID)
                ->first();

            if (!$combination) {
                return response()->json([
                    'message' => 'آیتم مورد نظر یافت نشد',
                ], 404);
            }

            // حذف ترکیب
            $combination->delete();
        }

        // اگر آیتم بدون ترکیب باقی نماند، آن را از سبد خرید حذف کن
        if (!$request->filled('combinationsID') || !$orderItem->combinations()->exists()) {
            $orderItem->delete();
        }

        return response()->json([
            'message' => 'محصول با موفقیت از سبد خرید حذف شد',
        ]);
    }



}
