<?php

namespace App\Http\Controllers;

use App\Models\DiscountCode;
use Illuminate\Http\Request;
use App\Traits\AuthorizeAccess;
use App\Models\UserDiscountCode;
use App\Models\Order; // جایگزینی با مدل مناسب برای سبد خرید در صورت لزوم

class CartController extends Controller
{
    use AuthorizeAccess;

    public function __construct()
    {
        // تنظیم نام دسترسی مورد نیاز
        $this->permissionName = 'manage_carts';
    }

    public function index(Request $request)
    {
        $query = Order::query();

        // اعمال فیلتر بر اساس دسترسی‌های کاربر
        $query = $this->applyAccessControl($query);

        // جستجو بر اساس نام کاربر یا شماره تلفن
        $search = $request->input('s');
        if ($search) {
            $query->whereHas('user', function ($q) use ($search) {
                $q->where('full_name', 'like', "%{$search}%")
                  ->orWhere('mobile', 'like', "%{$search}%");
            })->where('status', 'basket');
        }

        // صفحه‌بندی نتایج
        $orders = $query->paginate(10);

        return view('carts', compact('orders'));
    }

    public function create()
    {
        // نمایش فرم ایجاد سبد خرید کاربر
        return view('cart');
    }

    public function edit($id)
    {
        // نمایش فرم ویرایش سبد خرید با شناسه $id
        // اینجا باید کدی نوشته شود که سبد خرید مربوطه را بارگیری کند و به ویو مناسب منتقل کند
        $order = Order::findOrFail($id);
        $this->authorizeAction($order);
        //dd($order->basket());
        return view('cart', compact('order'));
    }

    public function update(Request $request, $id)
    {
        $order = Order::findOrFail($id);
        $this->authorizeAction($order);
        $this->saveOrder($order, $request);
        return redirect()->route('cart.index')->with('success', 'سبد خرید با موفقیت ویرایش شد.');
    }

    private function saveOrder(Order $order, Request $request)
    {
        $discountCode = $request->input('discount_code', null);
        //user discount model for search discount_code
        if($discountCode)
            $discount = DiscountCode::where('code', $discountCode)->first();

        // ذخیره اطلاعات کاربر و قیمت
        $order->user_id = $request->input('user');
        $order->discount_code_id = $discount->id ?? null;
        $order->save();


        if ($discountCode) {
            // بررسی وجود تخفیف برای این کاربر و ذخیره‌سازی آن
            UserDiscountCode::updateOrCreate(
                ['user_id' => $order->user_id, 'discount_code_id' => $discount->id],
                ['user_id' => $order->user_id, 'discount_code_id' => $discount->id]
            );
        }

        // حذف آیتم‌های قبلی و اضافه‌کردن آیتم‌های جدید به سفارش
        $order->orderItems()->delete();
        foreach ($request->input('products_repeater') as $productInput) {
            $order->orderItems()->create([
                'product_id' => $productInput['option']['product'],
                'quantity' => $productInput['quantity'] ?? 1,
            ]);
        }
    }


    public function delete(Request $request)
    {
        // حذف سبد خریدهای انتخاب شده
        $selectedOrders = $request->input('checked_row', []);

        if (!empty($selectedOrders)) {
            Order::whereIn('id', $selectedOrders)->delete();
        }

        return redirect()->back()->with('success', 'سبد خریدهای انتخاب شده با موفقیت حذف شدند.');
    }
}
