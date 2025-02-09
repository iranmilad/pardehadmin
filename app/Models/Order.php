<?php

namespace App\Models;

use Morilog\Jalali\Jalalian;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\Log;
use App\Events\OrderCreated;

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

    protected static function booted()
    {
        parent::booted();
        static::created(function ($order) {

            OrderCreated::dispatch($order);
        });
    }


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

    public function basket()
    {
        $status = [];
        $cartCount = 0; // Initialize cart count
        $totalPrice = 0; // Initialize total price
        $availableCreditPlan = 0;
        $items = []; // Initialize cart items array
        $summedAmounts = [];
        $totalDiscount = 0; // Initialize total discount
        $totalTime = 0; // Initialize total time
        $order = $this;

        if ($order) {
            $cartItems = $order->orderItems;

            // بررسی و اعمال کد تخفیف
            $discountCode = $order->discountCode; // دریافت کد تخفیف مربوط به سفارش

            // لیست محصولات مجاز و غیر مجاز برای کد تخفیف
            $allowedProducts = $discountCode ? $discountCode->allowedProducts->pluck('id')->toArray() : [];

            foreach ($cartItems as $cartItem) {
                $totalAttributePrice = 0;
                $totalAttributeSalePrice = 0;

                $product = $cartItem->product;
                $status[] = $cartItem->status;

                if ($product) {
                    $review = $order->user->existsProductReview($product->id);
                    $attributeCombinations = $cartItem->combinations; // دریافت ترکیبات ویژگی‌ها از متد combinations
                    $attributeCombinationsID = $attributeCombinations[0]->id ?? null;
                    $quantity = $cartItem->quantity;
                    if ($product->minimum_quantity == "quantity") {
                        $cartCount += $quantity;
                    } else {
                        $cartCount += 1;
                    }

                    $attributeNames = [];
                    $options = [];
                    $optionsFull = [];

                    $timePerUnit = 0; // Initialize time per unit for current item

                    foreach ($attributeCombinations as $attributeCombination) {

                        $priceAttr = $attributeCombination->sale_price ?? $attributeCombination->price;
                        $totalAttributePrice += $priceAttr;
                        foreach ($attributeCombination->attributeProperties as $attributeProperty) {
                            if (!is_null($attributeProperty->attribute->name)) {
                                $attributeNames[] = $attributeProperty->attribute->name;
                                $options[] = [$attributeProperty->attribute->name => $attributeProperty->property->value];
                                $optionsFull[] = [
                                    "attributeID"=>$attributeProperty->attribute->id,
                                    "propertyID"=>$attributeProperty->property->id,
                                    "propertyName"=>$attributeProperty->property->value,
                                    "attributeName"=>$attributeProperty->attribute->name,
                                ];
                            }
                        }

                        // جمع زمان هر واحد برای این ترکیب
                        $timePerUnit += $attributeCombination->time_per_unit ?? 0;
                    }

                    // محاسبه زمان کل برای این آیتم
                    $timeTotal = $timePerUnit * $quantity;
                    $totalTime += $timeTotal;

                    $totalPrice += $cartItem->total * $quantity;

                    // محاسبه تخفیف بر اساس نوع کد تخفیف
                    if ($discountCode) {
                        $applyDiscount = false;

                        // بررسی اینکه محصول جزو محصولات مجاز است
                        if (!empty($allowedProducts) && in_array($product->id, $allowedProducts) || empty($allowedProducts)) {
                            $applyDiscount = true;
                        }

                        // محاسبه تخفیف بر اساس نوع تخفیف
                        if ($applyDiscount) {
                            switch ($discountCode->discount_type) {
                                case 'percentage_cart':
                                    // تخفیف درصدی روی کل سبد خرید
                                    $totalDiscount += $totalPrice * ($discountCode->discount_amount / 100);
                                    break;

                                case 'percentage_product':
                                    // تخفیف درصدی روی محصولات خاص
                                    $totalDiscount += $cartItem->total * ($discountCode->discount_amount / 100) * $quantity;
                                    break;

                                case 'fixed_cart':
                                    // تخفیف ثابت روی کل سبد خرید (برای کل سبد تنها یکبار تخفیف اعمال می‌شود)
                                    $totalDiscount = $discountCode->discount_amount; // فقط یکبار اعمال می‌شود
                                    break;

                                case 'fixed_product':
                                    // تخفیف ثابت روی محصولات خاص
                                    $totalDiscount += $discountCode->discount_amount * $quantity; // تخفیف ثابت برای هر واحد محصول
                                    break;
                            }
                        }
                    }

                    $credit = $product->creditInstallmentTimeline($cartItem->total);
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
                        "price" => $cartItem->price,
                        "sale_price" => $cartItem->sale_price,
                        "discountPercentage" => $product->discountPercentage,
                        "review" => $review,
                        "status" => $cartItem->status,
                        'options' => $options,
                        "optionsFull" => $optionsFull,
                        "quantity" => $quantity,
                        "combination"=> $attributeCombinationsID,
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
                        "total" => $cartItem->total,
                        "time_per_unit" => $timePerUnit, // زمان هر واحد
                        "time_total" => $timeTotal, // زمان کل
                        "supplier" => $cartItem->supplier, //
                    ];
                }
            }

            $totalTimeline = $this->calculateDueDates($summedAmounts);
            $availableCreditPlan = ($order->paymentMethod == 'credit') ? $availableCreditPlan : 0;
            $availableCheck = ($order->paymentMethod == 'check') ? $order->getTotalUnpaidChecksAmount() : 0;
            $deliveryCost = $this->deliveryCost($order);

            // محاسبه مبلغ نهایی قابل پرداخت با در نظر گرفتن تخفیف
            $totalPayed = $totalPrice + $deliveryCost - $availableCreditPlan - $availableCheck - $totalDiscount;

            $orders = (object)[
                "cart" => (object)[
                    "id" => $order->id,
                    "count" => $cartCount,
                    "status" => $status,
                    "orderStatus" => $order->status,
                    "total" => number_format($totalPrice),
                    'deliveryType' => $order->deliveryType,
                    'discount_amount' => number_format($totalDiscount), // نمایش مبلغ تخفیف
                    'paymentMethod' => $order->paymentMethod,
                    'deliveryCost' => number_format($deliveryCost),
                    'availableCreditPlan' => number_format($availableCreditPlan),
                    "availableCheck" => number_format($availableCheck),
                    'totalTimeline' => $totalTimeline,
                    'totalCheckTimeline' => $order->checks,
                    'createdAtDate' => $this->gregorianToJalalian($order->created_at_date),
                    "totalPayed" => number_format($totalPayed), // نمایش مبلغ نهایی قابل پرداخت
                    'totalTime' => number_format($totalTime), // نمایش زمان کل
                    'tax' => 0 ,
                    'time_delivery' => round($totalTime/24)+2,
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
                    'discount_amount' => 0,
                    'paymentMethod' => 'cash',
                    'deliveryCost' => 0,
                    'availableCreditPlan' => 0,
                    "availableCheck" => 0,
                    'totalTimeline' => [],
                    'totalCheckTimeline' => [],
                    'createdAtDate' => '',
                    "totalPayed" => 0,
                    'totalTime' => 0, // زمان کل
                    'tax' => 0 ,
                    'time_delivery' => 2,
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

    private function deliveryCost($order)
    {
        if ($order->deliveryType == 'home_delivery') {
            if ($order->shipping_city && $order->shipping_province) {
                // دریافت تمامی مناطق حمل‌ونقل
                $transportRegions = TransportRegion::all();

                // متغیر جمع هزینه نهایی
                $totalCost = 0;

                // محاسبه هزینه برای هر آیتم موجود در سفارش
                foreach ($order->orderItems as $orderItem) {
                    $product = $orderItem->product;
                    $cartValue = $orderItem->total;
                    $weight = $product->weight;
                    $dimensions = [
                        'length' => $product->length,
                        'width' => $product->width,
                        'height' => $product->height,
                    ];

                    // بررسی تطابق شهر و استان با مناطق موجود
                    foreach ($transportRegions as $region) {
                        // اگر regions خالی بود، منظور همه مناطق است
                        if ($region->regions==[] || in_array($order->shipping_city, $region->regions)) {
                            // مطابقت نوع هزینه حمل‌ونقل با محصول
                            if ($region->cost_type == $product->cost_calculation_class) {
                                switch ($region->cost_type) {
                                    case 'fixed_rate':
                                        $totalCost += $region->price; // هزینه ثابت
                                        break;

                                    case 'weight_based':
                                        $totalCost += $this->calculateWeightBasedCost($region, $weight); // محاسبه براساس وزن
                                        break;

                                    case 'volume_based':
                                        $totalCost += $this->calculateVolumeBasedCost($region, $dimensions); // محاسبه براساس حجم
                                        break;

                                    case 'value_based':
                                        $totalCost += $this->calculateValueBasedCost($region, $cartValue); // محاسبه براساس ارزش
                                        break;

                                    default:
                                        $totalCost += 0; // اگر نوع حمل‌ونقل مشخص نبود، هزینه صفر
                                }
                                // یک منطقه تطابق یافت، ادامه نمی‌دهیم
                                break;
                            }
                        }
                    }
                }
                return $totalCost;
            }
        }

        // اگر منطقه‌ای یافت نشود یا اطلاعات نامعتبر باشد، هزینه ارسال صفر برمی‌گردد
        return 0;
    }


    private function calculateWeightBasedCost($region, $weight)
    {
        return $region->weight_based_cost * $weight;
    }

    private function calculateValueBasedCost($region, $cartValue)
    {
        return $region->percentage_of_cart_value * $cartValue;
    }

    private function calculateVolumeBasedCost($region, $dimensions)
    {
        $volume = $dimensions['length'] * $dimensions['width'] * $dimensions['height'];
        return $region->dimension_based_cost * $volume;
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

    public function applyDiscountCode($discountCode)
    {
        // بررسی اعتبار کد تخفیف
        $discount = DiscountCode::where('code', $discountCode)
                                ->where('status', 'active')
                                ->where('discount_expire_start', '<=', now())
                                ->where('discount_expire_end', '>=', now())
                                ->first();

        if (!$discount) {
            return [
                'success' => false,
                'message' => 'Invalid or expired discount code.'
            ];
        }

        // بررسی محدودیت استفاده از کد
        if ($discount->is_used || ($discount->usage_limit && $discount->usage_count >= $discount->usage_limit)) {
            return [
                'success' => false,
                'message' => 'This discount code has reached its usage limit.'
            ];
        }

        // بررسی محصولات مجاز و غیر مجاز
        $allowedProducts = $discount->allowedProducts->pluck('id')->toArray();


        $orderItems = $this->orderItems;
        $totalDiscount = 0;

        foreach ($orderItems as $item) {

            if ($allowedProducts && !in_array($item->product_id, $allowedProducts)) {
                continue; // اگر محصولات مجاز وجود داشته باشد و محصول جزو آنها نباشد، تخفیف اعمال نمی‌شود
            }

            // محاسبه تخفیف
            if ($discount->discount_type === 'percentage') {
                $discountAmount = $item->total * ($discount->discount_amount / 100);
            } else {
                $discountAmount = $discount->discount_amount;
            }

            $totalDiscount += $discountAmount;
        }

        // اعمال تخفیف بر روی کل سفارش
        $this->discount_code_id = $discount->id;
        $this->save();

        // بروزرسانی تعداد استفاده از کد تخفیف
        $discount->usage_count++;
        $discount->save();

        return [
            'success' => true,
            'total_discount' => $totalDiscount,
            'message' => 'Discount applied successfully.'
        ];
    }

}
