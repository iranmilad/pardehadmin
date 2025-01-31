<?php
namespace App\Http\Controllers\Api;

use App\Models\Order;
use Illuminate\Http\Request;
use Morilog\Jalali\Jalalian;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class OrderController extends Controller
{
    public function index(Request $request)
    {
        $user = auth()->user(); // دریافت کاربر احراز هویت شده

        $page = $request->input('page', 1);
        $perPage = 10; // تعداد سفارشات در هر صفحه

        $query = Order::where('user_id', $user->id)->latest();
        $totalOrders = $query->count();
        $orders = $query->paginate($perPage, ['*'], 'page', $page);

        $items = $orders->map(function ($order) {
            return [
                'id' => (string) $order->id,
                'date' => Jalalian::fromCarbon($order->created_at)->format('Y/m/d'), // تبدیل تاریخ میلادی به شمسی
                'status' => $this->mapStatus($order->status), // تبدیل وضعیت به فارسی
                'total' => number_format($order->total_price),
            ];
        });

        return response()->json([
            'message' => 'ok',
            'data' => [
                'items' => $items,
                'totalPage' => $totalOrders > $perPage ? $orders->lastPage() : 0
            ]
        ]);
    }

    private function mapStatus($status)
    {
        $statuses = [
            'pending' => 'درحال بررسی',
            'processing' => 'در حال پردازش',
            'shipped' => 'ارسال شده',
            'delivered' => 'تحویل شده',
            'canceled' => 'لغو شده'
        ];

        return $statuses[$status] ?? 'نامشخص';
    }

    public function getOrderResponse($id)
    {
        $order = Order::with([
            'user',
            'orderItems.product',
            'orderItems.combinations.suppliers',
            'discountCode',
        ])->findOrFail($id);

        // استفاده از متد basket برای دریافت داده‌های سبد خرید
        $basketData = $order->basket();

        // تبدیل داده‌های محصولات به Collection اگر آرایه باشد
        $products = collect($basketData->items)->map(function ($item) {
            return [
                'id' => $item->product_id, // شناسه محصول
                'imageUrl' => $item->img, // آدرس تصویر محصول
                'name' => $item->name, // نام محصول
                'description' => $item->product->description ?? null, // توضیحات محصول
                'price' => $item->price, // قیمت محصول
                'options' => collect($item->options)->map(function ($option) {
                    return $option ?? []; // استخراج گزینه ویژگی‌ها
                })->toArray(), // گزینه‌ها
                'seller' => $item->supplier ? [
                    'name' => $item->supplier->name,
                    'id' => $item->supplier->id,
                ] : null, // اگر تأمین‌کننده وجود نداشت، آرایه خالی برگردانده می‌شود

            ];
        });

        $response = [
            'message' => 'ok',
            'data' => [
                'deliveryConfirmation' => $order->deliveryConfirmation ?? false, // false, true, pending
                'recipient' => $order->customer_name, // نام دریافت‌کننده
                'phoneNumber' => $order->customer_phone_number, // شماره تماس
                'address' => $order->user->address, // آدرس
                'totalAmount' => $basketData->cart->total, // مبلغ کل
                'discountAmount' => $basketData->cart->discount_amount, // مبلغ تخفیف
                'discountCode' => $order->discountCode ? $order->discountCode->code : null, // کد تخفیف
                'products' => $products, // محصولات به فرمت جدید
                
            ],
        ];

        return response()->json($response);
    }

    
    public function confirmOrder($id, Request $request)
    {
        // اعتبارسنجی ورودی
        $validator = Validator::make($request->all(), [
            'status' => 'required|in:true,false',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => 'Invalid status'], 400);
        }

        // دریافت سفارش با استفاده از شناسه
        $order = Order::findOrFail($id);

        // بررسی وضعیت ارسال‌شده و تغییر وضعیت به complete
        if ($request->status === 'true') {
            $order->status = 'complete';
            $order->save();

            return response()->json([
                'message' => 'ok',
                'data' => [
                    'status' => $order->status
                ]
            ]);
        }

        return response()->json([
            'message' => 'Status not changed',
            'data' => [
                'status' => $order->status
            ]
        ]);
    }    


}
