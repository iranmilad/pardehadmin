<?php

namespace App\Http\Controllers\API;

use App\Models\Order;
use App\Models\OrderItem;

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
            'combinationsID' => 'nullable|integer|exists:product_attribute_combinations,id',
            'seller' => 'nullable|integer|exists:suppliers,id',
        ]);

        $user = Auth::user();

        // گرفتن یا ساختن سفارش سبد خرید
        $order = Order::firstOrCreate([
            'user_id' => $user->id,
            'status' => 'basket',
        ]);

        $product = Product::findOrFail($request->productId);
        $supplier = $request->seller ? Supplier::find($request->seller) : null;
        $combination = $request->combinationsID ? ProductAttributeCombination::find($request->combinationsID) : null;

        // جستجوی آیتم موجود در سبد خرید
        $orderItemQuery = OrderItem::where('order_id', $order->id)
            ->where('product_id', $product->id)
            ->where('supplier_id', $supplier ? $supplier->id : null);

        if ($combination) {
            $orderItemQuery->where('combination_id', $combination->id);
        } else {
            $orderItemQuery->whereNull('combination_id');
        }

        $orderItem = $orderItemQuery->first();

        // قیمت نهایی بر اساس ترکیب یا خود محصول
        $price = $combination ? $combination->price : $product->price;
        $salePrice = $combination ? $combination->sale_price : $product->sale_price;
        $finalPrice = $salePrice ?? $price;

        if ($orderItem) {
            // بروزرسانی تعداد و قیمت
            $orderItem->quantity = $request->count;
            $orderItem->total = $request->count * $finalPrice;
            $orderItem->save();
        } else {
            // ایجاد آیتم جدید
            $orderItem = OrderItem::create([
                'id' => rand(1111111, 9999999),
                'order_id' => $order->id,
                'product_id' => $product->id,
                'quantity' => $request->count,
                'price' => $price,
                'sale_price' => $salePrice,
                'total' => $request->count * $finalPrice,
                'status' => 'waiting',
                'supplier_id' => $supplier ? $supplier->id : null,
                'combination_id' => $combination ? $combination->id : null,
            ]);
        }

        // ساخت اطلاعات سبد خرید
        $cartItems = [];

        foreach ($order->items as $item) {
            $cartItems[] = [
                'productId' => $item->product_id,
                'attributes' => $item->combination_id,
                'seller' => $item->supplier_id,
                'count' => $item->quantity,
            ];
        }

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
                    'message' => 'فروشنده مورد نظر یافت نشد',
                ], 404);
            }
        }

        // پیدا کردن آیتم در سبد خرید
        $orderItemQuery = OrderItem::where('order_id', $order->id)
            ->where('product_id', $product->id);

        if ($supplier) {
            $orderItemQuery->where('supplier_id', $supplier->id);
        }

        if ($request->filled('combinationsID')) {
            $orderItemQuery->where('combination_id', $request->combinationsID);
        }

        $orderItem = $orderItemQuery->first();

        if (!$orderItem) {
            return response()->json([
                'message' => 'آیتم مورد نظر یافت نشد',
            ], 404);
        }

        // حذف آیتم از سبد خرید
        $orderItem->delete();

        return response()->json([
            'message' => 'محصول با موفقیت از سبد خرید حذف شد',
        ]);
    }




}
