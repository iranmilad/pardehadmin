<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order; // جایگزینی با مدل مناسب برای سبد خرید در صورت لزوم

class CartController extends Controller
{
    public function index(Request $request)
    {
        // جستجو بر اساس نام کاربر یا شماره تلفن
        $query = Order::query();

        if ($request->filled('s')) {
            $search = $request->input('s');
            $query->whereHas('user', function ($q) use ($search) {
                $q->where('full_name', 'like', "%$search%")
                    ->orWhere('mobile', 'like', "%$search%");
            })->where('status','basket');
        }

        $orders = $query->paginate(10); // تعداد سفارشات در هر صفحه

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
        //dd($order->basket());
        return view('cart', compact('order'));
    }

    public function update(Request $request, $id)
    {
        $order = Order::findOrFail($id);
        $this->saveOrder($order, $request);
        return redirect()->route('cart.index')->with('success', 'سبد خرید با موفقیت ویرایش شد.');
    }

    private function saveOrder(Order $order, Request $request)
    {
        $order->user_id = $request->input('user');
        $order->discount_code = $request->input('discount_code', null);
        $order->discount_percentage = $request->input('discount_percentage', 0);
        $order->total_price = $request->input('total_price', 0);
        $order->save();

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
