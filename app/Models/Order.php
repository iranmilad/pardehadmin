<?php

namespace App\Models;

use Morilog\Jalali\Jalalian;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [

        'customer_name',
        'customer_email',
        'customer_phone_number',
        'user_id',
        'is_self_delivery',
        'warehouse',
        'payment_id',
        'tax',
        'cart',
        'shipping_price',
        // اضافه کردن فیلدهای آدرس
        'shipping_country',
        'shipping_province',
        'shipping_city',
        'shipping_address',
        'shipping_postal_code',
        'shipping_phone',
        'shipping_note',
        'shipping_admin_note',
        // اضافه کردن فیلد کد تخفیف
        'discount_code_id',
        'deliveryType',
    ];


    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function discountCode()
    {
        return $this->belongsTo(DiscountCode::class);
    }

    public function payment()
    {
        return $this->belongsTo(Payment::class);
    }

    public function settlementDocuments()
    {
        return $this->hasMany(SettlementDocument::class);
    }

    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }

    // تعریف ارتباط یک به چند با مدل Check
    public function checks()
    {
        return $this->hasMany(Check::class);
    }

    /**
     * Get the total amount of unpaid checks for the user.
     *
     * @param int $userId
     * @return float
     */
    public static function getTotalUnpaidUserChecksAmount($userId)
    {
        return self::where('user_id', $userId)
            ->whereHas('checks', function ($query) {
                $query->where('payment_status', 'unpaid');
            })
            ->withSum('checks', 'amount')
            ->sum('checks.sum_amount');
    }


    /**
     * Get the total amount of unpaid checks for the order.
     *
     * @return float
     */
    public function getTotalUnpaidChecksAmount()
    {
        return $this->checks()
            ->where('payment_status', 'unpaid')
            ->sum('amount');
    }


    /**
     * Convert Create at date from Gregorian to Jalali (Shamsi).
     *
     * @return string
     */
    public function getCreatedAtShamsiAttribute()
    {
        // Parse the Gregorian date
        $gregorianDate = \Carbon\Carbon::parse($this->created_at);

        // Convert to Jalali (Shamsi)
        $jalaliDate = Jalalian::fromCarbon($gregorianDate);

        // Format the date as desired
        return $jalaliDate->format('Y/m/d');
    }


    /**
     * Convert delivery date from Gregorian to Jalali (Shamsi).
     *
     * @return string
     */
    public function getDeliveryDateShamsiAttribute()
    {
        // Parse the Gregorian date
        $gregorianDate = \Carbon\Carbon::parse($this->delivery_date);

        // Convert to Jalali (Shamsi)
        $jalaliDate = Jalalian::fromCarbon($gregorianDate);

        // Format the date as desired
        return $jalaliDate->format('Y/m/d');
    }

    /**
     * Generate detailed information about the shopping basket of the order.
     *
     * This function calculates various details related to the order's shopping basket,
     * including total price, item quantities, attributes, discounts, payment methods,
     * delivery costs, available credit plans, and timelines for payments.
     *
     * @return object Detailed information about the shopping basket:
     *                - cart: Detailed summary of the order including total price, payment details,
     *                        delivery type,items count, available credit plans, and more.
     *                - items: List of items in the shopping cart with details such as product ID,
     *                         name, price, quantity, attributes, and services associated.
     */
    public function basket()
    {
        $status = [];
        $cartCount = 0; // Initialize cart count
        $totalPrice = 0; // Initialize total price
        $availableCreditPlan = 0;
        $items = []; // Initialize cart items array
        $totalDiscountPrice = 0;
        $summedAmounts = [];
        $order = $this;

        if ($order) {
            $cartItems = $order->orderItems;

            foreach ($cartItems as $cartItem) {
                $totalAttributePrice = 0;
                $totalAttributeSalePrice = 0;

                $product = $cartItem->product;
                $status[] = $cartItem->status;

                if ($product) {
                    $review = $order->user->existsProductReview($product->id);
                    $attributeCombinations = $cartItem->combinations; // دریافت ترکیبات ویژگی‌ها از متد combinations
                    $quantity = $cartItem->quantity;
                    $cartCount += $quantity;

                    $attributeNames = [];
                    $options = [];

                    foreach ($attributeCombinations as $attributeCombination) {
                        foreach ($attributeCombination->attributeProperties as $attributeProperty) {
                            $priceAttr = $attributeProperty->sale_price ?? $attributeProperty->price;
                            if (!is_null($priceAttr)) {
                                $attributeNames[] = $attributeProperty->attribute->name;
                                $totalAttributeSalePrice += $priceAttr;
                                $totalAttributePrice += $attributeProperty->price;
                                $options[] = [$attributeProperty->attribute->name => $attributeProperty->property->value];
                            }
                        }
                    }

                    $price = $product->sale_price ?? $product->price;
                    $totalProductPrice = ($price + $totalAttributeSalePrice) * $quantity;
                    $totalPrice += $totalProductPrice;

                    $credit = $product->creditInstallmentTimeline($totalProductPrice);
                    $productTimeline = $credit->timeline;

                    foreach ($productTimeline as $key => $value) {
                        if (isset($summedAmounts[$key])) {
                            $summedAmounts[$key] += $value->amount;
                        } else {
                            $summedAmounts[$key] = $value->amount;
                        }
                    }

                    $availableCreditPlan += $credit->totalCredit;

                    $items[] = (object)[
                        "id" => $cartItem->id,
                        "product_id" => $product->id,
                        "name" => $product->title,
                        "img" => $product->img,
                        "link" => $product->link,
                        "price" => $product->price + $totalAttributePrice,
                        "sale_price" => $product->sale_price + $totalAttributeSalePrice,
                        "discountPercentage" => $product->discountPercentage,
                        "review" => $review,
                        "status" => $cartItem->status,
                        'options' => $options,
                        "quantity" => $quantity,
                        "attribute" => $attributeNames,
                        "credit" => $credit,
                        "service" => $product->service,
                        "services" => (object)[
                            "sewing" => $product->services()->where('type', 'sewing')->first(),
                            "installer" => $product->services()->where('type', 'installer')->first(),
                            "design" => $product->services()->where('type', 'design')->first(),
                        ],
                        "installer" => $cartItem->installer ?? null,
                        "sewing" => $cartItem->sewing ?? null,
                        "design" => $cartItem->design ?? null,
                        "total" => ($product->sale_price ?? $product->price + $totalAttributeSalePrice) * $quantity,
                    ];
                }
            }

            $totalTimeline = $this->calculateDueDates($summedAmounts);
            $availableCreditPlan = ($order->paymentMethod == 'credit') ? $availableCreditPlan : 0;
            $availableCheck = ($order->paymentMethod == 'check') ? $order->getTotalUnpaidChecksAmount() : 0;
            $deliveryCost = $this->deliveryCost($order);

            $orders = (object)[
                "cart" => (object)[
                    "id" => $order->id,
                    "count" => $cartCount,
                    "status" => $status,
                    "orderStatus" => $order->status,
                    "total" => number_format($totalPrice),
                    'deliveryType' => $order->deliveryType,
                    'paymentMethod' => $order->paymentMethod,
                    'deliveryCost' => $deliveryCost,
                    'availableCreditPlan' => number_format($availableCreditPlan),
                    "availableCheck" => number_format($availableCheck),
                    'totalTimeline' => $totalTimeline,
                    'totalCheckTimeline' => $order->checks,
                    'createdAtDate' => $this->gregorianToJalalian($order->created_at_date),
                    "totalPayed" => number_format($totalPrice + $totalDiscountPrice + $deliveryCost - $availableCreditPlan - $availableCheck),
                ],
                "items" => $items,
            ];
        } else {
            $orders = (object)[
                "cart" => (object)[
                    "count" => $cartCount,
                    "status" => [],
                    "orderStatus" => $order->status,
                    "total" => 0,
                    'deliveryType' => 'cash',
                    'paymentMethod' => 'cash',
                    'deliveryCost' => 0,
                    'availableCreditPlan' => 0,
                    "availableCheck" => 0,
                    'totalTimeline' => [],
                    'totalCheckTimeline' => [],
                    'createdAtDate' => '',
                    "totalPayed" => 0,
                ],
                "items" => [],
            ];
        }

        return $orders;
    }



    public function percentOfFinishedItem()
    {
        $orderItems =$this->orderItems ;
        $total =0;
        $finished=0;
        foreach($orderItems as $item){
            $total +=1;
            if($item->status == "complete" or $item->status == "referral"){
                $finished+=1;
            }
        }

        return round( $finished/$total*100,2) ?? 0;

    }


    /**
     * Convert date from Gregorian to Jalali (Shamsi).
     *
     * @return string
     */
    private function gregorianToJalalian($date)
    {
        // Parse the Gregorian date
        $gregorianDate = \Carbon\Carbon::parse($date);

        // Convert to Jalali (Shamsi)
        $jalaliDate = Jalalian::fromCarbon($gregorianDate);

        // Format the date as desired
        return $jalaliDate->format('Y/m/d');
    }


    private function calculateDueDates(array $summedAmounts): array
    {
        // تاریخ فعلی را دریافت می‌کنیم
        $currentDate = Jalalian::now();

        // آرایه‌ای برای نگهداری تاریخ‌های سررسید و مقادیر
        $totalTimeline = [];

        foreach ($summedAmounts as $month => $amount) {
            // محاسبه تاریخ سررسید بر اساس فاصله ماه و تاریخ فعلی
            $dueDate = $currentDate->addMonths($month);

            // اضافه کردن تاریخ و مقدار به timeline کلی
            $totalTimeline[$dueDate->format('Y/m/d')] = (object) [
                'month' => $dueDate->format('Y/m/d'),
                'amount' => $amount,
            ];
        }

        return $totalTimeline;
    }


    private function deliveryCost($order){
        if($order->deliveryType=='home_delivery'){
            return 250000;
        }
        else{
            return 0;
        }
    }
    public function getTotalChecksCount()
    {
        return $this->checks()->count();
    }
    public function getPaidChecksCount()
    {
        return $this->checks()->where('payment_status', 'paid')->count();
    }
    public function getLastCheckPaymentDate()
    {
        // برگرداندن آخرین تاریخ پرداخت چک، اگر چکی با وضعیت پرداخت "paid" وجود داشته باشد
        $lastPaymentDate = $this->checks()
            ->where('payment_status', 'paid')
            ->latest('due_date')
            ->value('due_date');

        // اگر تاریخ پرداخت وجود داشته باشد، آن را به تاریخ شمسی تبدیل کرده و برمی‌گردانیم
        if ($lastPaymentDate) {
            return $this->gregorianToJalalian($lastPaymentDate);
        }

        // اگر هیچ چکی با وضعیت "paid" وجود نداشته باشد، null برمی‌گردانیم
        return null;
    }
    public function getnextDueDate()
    {
        // برگرداندن اولین تاریخ پرداخت چک، اگر چکی با وضعیت پرداخت "unpaid" وجود داشته باشد
        $firstPaymentDate = $this->checks()
            ->where('payment_status', 'unpaid')
            ->first('due_date')
            ->value('due_date');

        // اگر تاریخ پرداخت وجود داشته باشد، آن را به تاریخ شمسی تبدیل کرده و برمی‌گردانیم
        if ($firstPaymentDate) {
            return $this->gregorianToJalalian($firstPaymentDate);
        }

        // اگر هیچ چکی با وضعیت "unpaid" وجود نداشته باشد، null برمی‌گردانیم
        return null;
    }

}
