<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Morilog\Jalali\Jalalian;
use App\Traits\AuthorizeAccess;
use App\Rules\IranianNationalCode;
use Illuminate\Validation\ValidationException;


class OrderController extends Controller
{
    use AuthorizeAccess;

    public function __construct()
    {
        // تنظیم نام دسترسی مورد نیاز
        $this->permissionName = 'manage_orders';
    }

    // نمایش لیست سفارش‌ها
    public function index(Request $request)
    {
        // ساختن کوئری برای Order
        $query = Order::query();

        // اعمال فیلتر بر اساس دسترسی‌های کاربر
        $query = $this->applyAccessControl($query);

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
        return view('order-create');
    }


    public function store(Request $request)
    {
        // اعتبارسنجی داده‌ها
        $validated = $request->validate([
            'status' => 'required|string|in:basket,pending,processing,complete',
            'created_at' => 'required|string', // اعتبارسنجی رشته تاریخ
        ]);

        // گرفتن کاربر وارد شده
        $user = auth()->user();

        // تبدیل تاریخ شمسی به میلادی
        try {
            $createdAtJalali = $request->input('created_at');
            $createdAtGregorian = Jalalian::fromFormat('Y/m/d H:i', $createdAtJalali)->toCarbon();
        } catch (\Exception $e) {
            throw ValidationException::withMessages(['created_at' => 'فرمت تاریخ وارد شده نادرست است.']);
        }

        // ایجاد سفارش جدید با استفاده از اطلاعات کاربر
        $order = new Order();
        $order->user_id = $user->id;
        $order->status = $request->input('status');
        $order->created_at = $createdAtGregorian;

        // پر کردن فیلدهای مربوط به آدرس، کد پستی و تلفن از اطلاعات کاربر
        $order->customer_name = $user->first_name . ' ' . $user->last_name;
        $order->customer_email = $user->email;
        $order->customer_phone_number = $user->mobile;
        $order->is_self_delivery = 1;
        $order->shipping_country = $user->country;
        $order->shipping_province = $user->province;
        $order->shipping_city = $user->city;
        $order->shipping_address = $user->address;
        $order->shipping_postal_code = $user->postal_code;
        $order->shipping_phone = $user->phone;

        // ذخیره‌سازی سفارش جدید
        $order->save();

        // هدایت به لیست سفارش‌ها با پیام موفقیت
        return redirect()->route('orders.index')->with('success', 'سفارش با موفقیت ایجاد شد.');
    }


    // نمایش فرم ویرایش سفارش
    public function edit($id)
    {
        $order = Order::findOrFail($id);
        $this->authorizeAction($order);

        return view('order', compact('order'));
    }

    // به‌روزرسانی سفارش
    public function update(Request $request, $id)
    {
        // اعتبارسنجی داده‌ها
        $validated = $request->validate([
            'customer_name' => 'required|string|max:255',
            'customer_email' => 'required|email|max:255',
            'national_code' => ['nullable', 'string', new IranianNationalCode()],
            // افزودن سایر فیلدهای مورد نیاز برای سفارش
        ]);

        // یافتن سفارش و به‌روزرسانی
        $order = Order::findOrFail($id);
        $this->authorizeAction($order);

        $order->update($validated);

        // هدایت به لیست سفارش‌ها با پیام موفقیت
        return redirect()->route('orders.index')->with('success', 'سفارش با موفقیت به‌روزرسانی شد.');
    }

    // حذف سفارش
    public function delete(Request $request)
    {
        // یافتن و حذف سفارش
        $order = Order::findOrFail($request->id);
        $order->delete();

        // هدایت به لیست سفارش‌ها با پیام موفقیت
        return redirect()->route('orders.index')->with('success', 'سفارش با موفقیت حذف شد.');
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
        return redirect()->route('orders.index')->with('success', 'عملیات با موفقیت انجام شد.');
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
        $this->authorizeAction($order);

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
        $this->authorizeAction($order);

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
        $this->authorizeAction($order);

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
        $this->authorizeAction($orderItem->order);

        $product_id = $request->input('product_id');
        $newQuantity = $request->input('quantity');
        $attributes = $request->input('param.attribute');

        // پیدا کردن ترکیب ویژگی‌ها
        $combination = $orderItem->findCombinationByAttributes($attributes);

        if (!$combination) {
            return back()->withErrors(['message' => 'ترکیب ویژگی مورد نظر یافت نشد.']);
        }

        $oldQuantity = $orderItem->quantity;
        $quantityDifference = $newQuantity - $oldQuantity;

        // بررسی موجودی بر اساس تغییرات تعداد
        if ($quantityDifference > 0 && $combination->stock_quantity < $quantityDifference) {
            return back()->withErrors(['message' => "مقدار موجودی ترکیب ویژگی فعلی تنها {$combination->stock_quantity} است."]);
        }

        // به‌روزرسانی فیلدهای آیتم سفارش
        $orderItem->combination_id = $combination->id;
        $orderItem->quantity = $newQuantity;
        $orderItem->price = $combination->price;
        $orderItem->sale_price = $combination->sale_price;
        $orderItem->total = $combination->sale_price * $newQuantity;
        $orderItem->save();

        // به‌روزرسانی موجودی ترکیب ویژگی
        if ($quantityDifference > 0) {
            $combination->stock_quantity -= $quantityDifference;
        } else {
            $combination->stock_quantity += abs($quantityDifference);
        }
        $combination->save();

        return back()->with('success', 'ویژگی‌های محصول با موفقیت به‌روزرسانی شد.');
    }


    public function addProduct(Request $request, $orderId)
    {
        // Validate the request data
        $validated = $request->validate([
            'product_id' => 'required|integer|exists:products,id',
            'quantity' => 'required|integer|min:1',
        ]);

        // Find the order
        $order = Order::findOrFail($orderId);
        $this->authorizeAction($order);
        // Find the product
        $product = Product::findOrFail($validated['product_id']);

        // Create a new order item
        $orderItem = new OrderItem([
            'id' => rand(1000000,9999999),
            'product_id' => $product->id,
            'quantity' => $validated['quantity'],
            'price' => $product->price,
            'sale_price' => $product->sale_price,
            'total' => $product->sale_price * $validated['quantity'],
        ]);

        // Associate the order item with the order
        $order->orderItems()->save($orderItem);

        return redirect()->route('orders.edit', $orderId)->with('success', 'محصول با موفقیت به سفارش اضافه شد.');
    }



    public function updateStatusAndDate(Request $request, $id)
    {
        // یافتن سفارش
        $order = Order::findOrFail($id);
        $this->authorizeAction($order);

        // اعتبارسنجی داده‌ها
        $validated = $request->validate([
            'status' => 'required|string|in:basket,pending,processing,complete,cancel,reject',
            'created_at' => 'required|string', // مقدار تاریخ به‌صورت رشته از فرم ارسال می‌شود
        ]);

        $createdAtInput = $validated['created_at'];

        // بررسی اینکه تاریخ در فرمت شمسی است (1300/xx/xx یا 1400/xx/xx)
        if (preg_match('/^(13|14)\d{2}\/\d{2}\/\d{2} \d{2}:\d{2}$/', $createdAtInput)) {
            try {
                // تبدیل تاریخ شمسی به میلادی
                $createdAtGregorian = Jalalian::fromFormat('Y/m/d H:i', $createdAtInput)->toCarbon();
            } catch (\Exception $e) {
                return redirect()->back()->withErrors(['created_at' => 'فرمت تاریخ شمسی وارد شده نادرست است.']);
            }

            // بروزرسانی وضعیت و تاریخ سفارش
            $order->update([
                'status' => $validated['status'],
                'created_at' => $createdAtGregorian, // ذخیره تاریخ میلادی
            ]);
        } else {
            // فقط وضعیت را بروزرسانی کن و تاریخ را تغییر نده
            $order->update([
                'status' => $validated['status'],
            ]);
        }

        // بازگرداندن پیام موفقیت
        return redirect()->route('orders.edit', $order->id)->with('success', 'وضعیت و تاریخ سفارش با موفقیت بروزرسانی شد.');
    }




}
