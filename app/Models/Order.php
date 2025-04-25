<?php

namespace App\Models;

use App\Events\OrderCreated;
use Morilog\Jalali\Jalalian;
use PhpMonsters\Larapay\Payable;
use App\Events\OrderStatusUpdated;
use Illuminate\Support\Facades\Log;
use Illuminate\Database\Eloquent\Model;
use App\Traits\ShippingCostAndTimeCalculator;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Order extends Model
{
    use HasFactory;
    use ShippingCostAndTimeCalculator;

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
        'status'
    ];

    protected static function booted()
    {
        parent::booted();

        static::created(function ($order) {
            OrderCreated::dispatch($order);
        });

        static::updating(function ($order) {
            Log::info("🚀 Order updating triggered. Order ID: {$order->id}");

            if ($order->isDirty('status')) {
                $oldStatus = $order->getOriginal('status');
                $newStatus = $order->status;

                OrderStatusUpdated::dispatch($order, $oldStatus, $newStatus);
            } else {
                Log::info("ℹ️ Status did not change for Order ID: {$order->id}");
            }
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
        $order = $this;

        $summary = [
            'count' => 0,
            'totalPrice' => 0,
            'totalDiscount' => 0,
            'totalTime' => 0,
            'availableCreditPlan' => 0,
            'availableCheck' => 0,
            'deliveryCost' => 0,
        ];

        $items = [];
        $summedAmounts = [];
        $statusList = [];
        $allAvailable = true;

        if (!$order) {
            return $this->emptyBasket();
        }

        $cartItems = $order->orderItems;
        $discountCode = $order->discountCode;
        $allowedProducts = $discountCode ? $discountCode->allowedProducts->pluck('id')->toArray() : [];

        foreach ($cartItems as $cartItem) {
            $product = $cartItem->product;

            if (!$product) {
                continue;
            }

            $combination = $cartItem->combination;
            $attributeCombinationsID = $combination?->id;
            $quantity = $cartItem->quantity;
            $timePerUnit = 0;
            $attributeNames = [];
            $options = [];
            $optionsFull = [];
            $totalAttributePrice = 0;
            $isAvailable = false;

            if ($combination) {
                $priceAttr = $combination->sale_price ?? $combination->price;
                $totalAttributePrice += $priceAttr;
                $timePerUnit += $combination->time_per_unit ?? 0;
                $isAvailable = $combination->stock_quantity >= $quantity;

                foreach ($combination->attributeProperties as $property) {
                    $attributeNames[] = $property->attribute->name;
                    $options[] = [$property->attribute->name => $property->property->value];
                    $optionsFull[] = [
                        "attributeID" => $property->attribute->id,
                        "propertyID" => $property->property->id,
                        "propertyName" => $property->property->value,
                        "attributeName" => $property->attribute->name,
                    ];
                }
            } else {
                $isAvailable = $product->few >= $quantity;
            }

            // اگر حتی یک مورد ناموجود باشد
            if (!$isAvailable) {
                $allAvailable = false;
            }

            $timeTotal = $timePerUnit * $quantity;
            $summary['totalTime'] += $timeTotal;

            $summary['count'] += ($product->minimum_quantity == "quantity") ? $quantity : 1;
            $summary['totalPrice'] += $cartItem->total;

            if ($discountCode && (empty($allowedProducts) || in_array($product->id, $allowedProducts))) {
                $summary['totalDiscount'] += $this->calculateItemDiscount($cartItem, $quantity, $discountCode);
            }

            $credit = $product->creditInstallmentTimeline($cartItem->total);
            foreach ($credit->timeline as $key => $value) {
                $summedAmounts[$key] = ($summedAmounts[$key] ?? 0) + $value->amount;
            }
            $summary['availableCreditPlan'] += $credit->totalCredit;

            $supplier = $cartItem->supplier;
            $supplierData = $supplier ? ["id" => $supplier->id, "label" => $supplier->name] : null;

            $review = $order->user->existsProductReview($product->id);

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
                "options" => $options,
                "optionsFull" => $optionsFull,
                "quantity" => $quantity,
                "combination" => $attributeCombinationsID,
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
                "time_per_unit" => $timePerUnit,
                "time_total" => $timeTotal,
                "supplier" => $supplierData,
                "is_available" => $isAvailable,
            ];

            $statusList[] = $cartItem->status;
        }

        $deliveryOptions = $this->deliveryCost();
        $selectedRegionId = $order->deliveryType;
        $selectedDelivery = collect($deliveryOptions)->firstWhere('region_id', $selectedRegionId);
        $summary['deliveryCost'] = $selectedDelivery['cost'] ?? 0;

        $summary['availableCreditPlan'] = $order->paymentMethod == 'credit' ? $summary['availableCreditPlan'] : 0;
        $summary['availableCheck'] = $order->paymentMethod == 'check' ? $order->getTotalUnpaidChecksAmount() : 0;

        $totalTimeline = $this->calculateDueDates($summedAmounts);
        $totalPayed = $summary['totalPrice'] + $summary['deliveryCost'] - $summary['availableCreditPlan'] - $summary['availableCheck'] - $summary['totalDiscount'];

        return (object)[
            "cart" => (object)[
                "id" => $order->id,
                "count" => $summary['count'],
                "status" => $statusList,
                "orderStatus" => $order->status,
                "total" => number_format($summary['totalPrice']),
                "deliveryType" => $order->deliveryType,
                "discount_amount" => number_format($summary['totalDiscount']),
                "paymentMethod" => $order->paymentMethod,
                "deliveryCost" => number_format($summary['deliveryCost']),
                "availableCreditPlan" => number_format($summary['availableCreditPlan']),
                "availableCheck" => number_format($summary['availableCheck']),
                "totalTimeline" => $totalTimeline,
                "totalCheckTimeline" => $order->checks,
                "createdAtDate" => $this->gregorianToJalalian($order->created_at_date),
                "totalPayed" => number_format($totalPayed),
                "totalTime" => number_format($summary['totalTime']),
                "tax" => 0,
                "time_delivery" => round($summary['totalTime'] / 24) + 2,
                "allAvailable" => $allAvailable,
            ],
            "items" => $items,
        ];
    }


    private function emptyBasket()
    {
        return (object)[
            "cart" => (object)[
                "count" => 0,
                "status" => [],
                "orderStatus" => null,
                "total" => 0,
                "deliveryType" => 'cash',
                "discount_amount" => 0,
                "paymentMethod" => 'cash',
                "deliveryCost" => 0,
                "availableCreditPlan" => 0,
                "availableCheck" => 0,
                "totalTimeline" => [],
                "totalCheckTimeline" => [],
                "createdAtDate" => '',
                "totalPayed" => 0,
                "totalTime" => 0,
                "tax" => 0,
                "time_delivery" => 2,
            ],
            "items" => [],
        ];
    }

    private function calculateItemDiscount($item, $quantity, $discountCode)
    {
        switch ($discountCode->discount_type) {
            case 'percentage_cart':
                return $item->total * ($discountCode->discount_amount / 100) * $quantity;

            case 'percentage_product':
                return $item->total * ($discountCode->discount_amount / 100) * $quantity;

            case 'fixed_cart':
                return $discountCode->discount_amount;

            case 'fixed_product':
                return $discountCode->discount_amount * $quantity;

            default:
                return 0;
        }
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

    public function suppliers()
    {
        return $this->hasManyThrough(Supplier::class, OrderItem::class, 'order_id', 'id', 'id', 'supplier_id')->distinct();
    }
}
