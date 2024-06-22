<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use App\Models\ProductAttributeProperty;
use App\Models\ProductAttributeCombination;

class OrderController extends Controller
{
    // نمایش لیست سفارش‌ها
    public function index(Request $request)
    {
        $query = Order::query();

        // فیلتر کردن براساس جستجو
        if ($search = $request->get('s')) {
            $query->where('customer_name', 'LIKE', "%$search%")
                  ->orWhere('customer_email', 'LIKE', "%$search%");
        }

        // دریافت لیست سفارش‌ها
        $orders = $query->paginate(10);

        // ارسال لیست سفارش‌ها به ویو
        return view('orders', compact('orders'));
    }

    // نمایش فرم ایجاد سفارش جدید
    public function create()
    {
        return view('order');
    }

    // ذخیره سفارش جدید
    public function store(Request $request)
    {
        // اعتبارسنجی داده‌ها
        $validated = $request->validate([
            'customer_name' => 'required|string|max:255',
            'customer_email' => 'required|email|max:255',
            // افزودن سایر فیلدهای مورد نیاز برای سفارش
        ]);

        // ایجاد سفارش جدید
        $order = Order::create($validated);

        // هدایت به لیست سفارش‌ها با پیام موفقیت
        return redirect()->route('orders.list')->with('success', 'سفارش با موفقیت ایجاد شد.');
    }

    // نمایش فرم ویرایش سفارش
    public function edit($id)
    {
        $order = Order::findOrFail($id);
        return view('order', compact('order'));
    }

    // به‌روزرسانی سفارش
    public function update(Request $request, $id)
    {
        // اعتبارسنجی داده‌ها
        $validated = $request->validate([
            'customer_name' => 'required|string|max:255',
            'customer_email' => 'required|email|max:255',
            // افزودن سایر فیلدهای مورد نیاز برای سفارش
        ]);

        // یافتن سفارش و به‌روزرسانی
        $order = Order::findOrFail($id);
        $order->update($validated);

        // هدایت به لیست سفارش‌ها با پیام موفقیت
        return redirect()->route('orders.list')->with('success', 'سفارش با موفقیت به‌روزرسانی شد.');
    }

    // حذف سفارش
    public function delete(Request $request)
    {
        // یافتن و حذف سفارش
        $order = Order::findOrFail($request->id);
        $order->delete();

        // هدایت به لیست سفارش‌ها با پیام موفقیت
        return redirect()->route('orders.list')->with('success', 'سفارش با موفقیت حذف شد.');
    }

    // انجام عملیات‌های دسته‌ای
    public function bulk_action(Request $request)
    {
        $action = $request->action;
        $ids = $request->ids;

        if ($action == 'delete') {
            Order::whereIn('id', $ids)->delete();
        }

        // هدایت به لیست سفارش‌ها با پیام موفقیت
        return redirect()->route('orders.list')->with('success', 'عملیات با موفقیت انجام شد.');
    }

    public function print($id){
        $orders = Order::all();
        return view('order-print', compact('orders'));
    }


    /**
     * به‌روزرسانی اطلاعات صورت‌حساب
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updateBilling(Request $request, $id)
    {
        $order = Order::findOrFail($id);

        $validatedData = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'mobile' => 'required|string|max:15',
            'email' => 'required|email|max:255',
            'country' => 'required|string|max:100',
            'province' => 'required|string|max:100',
            'city' => 'required|string|max:100',
            'address' => 'required|string|max:255',
            'postal_code' => 'required|string|max:10',
            'billing_note' => 'nullable|string|max:1000',
        ]);

        $order->user->update([
            'first_name' => $validatedData['first_name'],
            'last_name' => $validatedData['last_name'],
            'mobile' => $validatedData['mobile'],
            'email' => $validatedData['email'],
            'country' => $validatedData['country'],
            'province' => $validatedData['province'],
            'city' => $validatedData['city'],
            'address' => $validatedData['address'],
            'postal_code' => $validatedData['postal_code'],
        ]);


        $order->save();

        return redirect()->route('orders.edit', $order->id)->with('success', 'اطلاعات صورت‌حساب با موفقیت به‌روزرسانی شد.');
    }
    /**
     * به‌روزرسانی اطلاعات حمل و نقل
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updateShipping(Request $request, $id)
    {
        $order = Order::findOrFail($id);

        $validatedData = $request->validate([
            'customer_name' => 'required|string|max:255',
            'shipping_phone' => 'required|string|max:15',
            'customer_email' => 'required|email|max:255',
            'shipping_country' => 'required|string|max:100',
            'shipping_province' => 'required|string|max:100',
            'shipping_city' => 'required|string|max:100',
            'shipping_address' => 'required|string|max:255',
            'shipping_note' => 'nullable|string|max:1000',
            'shipping_postal_code' => 'required|string|max:10',
        ]);

        $order->update([
            'customer_name' => $validatedData['customer_name'],
            'shipping_phone' => $validatedData['shipping_phone'],
            'customer_email' => $validatedData['customer_email'],
            'shipping_country' => $validatedData['shipping_country'],
            'shipping_province' => $validatedData['shipping_province'],
            'shipping_city' => $validatedData['shipping_city'],
            'shipping_address' => $validatedData['shipping_address'],
            'shipping_note' => $validatedData['shipping_note'],
            'shipping_postal_code' => $validatedData['shipping_postal_code'],
        ]);

        return redirect()->route('orders.edit', $order->id)->with('success', 'اطلاعات حمل و نقل با موفقیت به‌روزرسانی شد.');
    }
    /**
     * به‌روزرسانی یادداشت حمل و نقل
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updateShippingNote(Request $request, $id)
    {
        $order = Order::findOrFail($id);

        $validatedData = $request->validate([
            'shipping_admin_note' => 'nullable|string|max:1000',
        ]);

        $order->update([
            'shipping_admin_note' => $validatedData['shipping_admin_note'],
        ]);

        return redirect()->route('orders.edit', $order->id)->with('success', 'یادداشت حمل و نقل با موفقیت به‌روزرسانی شد.');
    }

    public function updateProductDetails(Request $request, $id)
    {
        // اعتبارسنجی ورودی‌ها
        $request->validate([
            'product_id' => 'required|integer|exists:products,id',
            'quantity' => 'required|integer|min:1',
            'param.attribute' => 'required|array'
        ]);

        $orderItem = OrderItem::findOrFail($id);
        $product_id = $request->input('product_id');
        $newQuantity = $request->input('quantity');
        $attributes = $request->input('param.attribute');

        // پیدا کردن ترکیب ویژگی‌ها
        $combinationQuery = ProductAttributeCombination::where('product_id', $product_id);

        foreach ($attributes as $attributeId => $propertyId) {
            $combinationQuery->whereHas('attributeProperties', function ($query) use ($attributeId, $propertyId) {
                $query->where('attribute_id', $attributeId)
                      ->where('property_id', $propertyId);
            });
        }

        $combination = $combinationQuery->first();

        if (!$combination) {
            return back()->withErrors(['message' => 'ترکیب ویژگی مورد نظر یافت نشد.']);
        }

        $oldQuantity = $orderItem->quantity;
        $quantityDifference = $newQuantity - $oldQuantity;

        // بررسی موجودی بر اساس تغییرات تعداد
        if ($quantityDifference > 0) {
            if ($combination->stock_quantity < $quantityDifference) {
                return back()->withErrors(['message' => "مقدار موجودی ترکیب ویژگی فعلی تنها {$combination->stock_quantity} است."]);
            }
        }

        // به روز رسانی آیتم سفارش با ترکیب ویژگی جدید
        $orderItem->combinations()->sync([$combination->id]);
        $orderItem->quantity = $newQuantity;

        // به روز رسانی قیمت‌ها
        $orderItem->price = $combination->price;
        $orderItem->sale_price = $combination->sale_price;
        $orderItem->total = $combination->sale_price * $newQuantity;
        $orderItem->save();

        // به روز رسانی موجودی ترکیب ویژگی
        if ($quantityDifference > 0) {
            $combination->stock_quantity -= $quantityDifference;
        } else {
            $combination->stock_quantity += abs($quantityDifference);
        }
        $combination->save();

        return back()->with('success', 'ویژگی‌های محصول با موفقیت به‌روزرسانی شد.');
    }
}
