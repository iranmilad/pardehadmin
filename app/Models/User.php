<?php

namespace App\Models;

use App\Models\Article;
use Morilog\Jalali\Jalalian;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

 class User extends Authenticatable
{
    use Notifiable;
	//use SoftDeletes;
    protected $fillable = [
        'password',
        'active',
        'first_name',
        'last_name',
        'mobile',
        'email',
        'email_verified_at',
        // اطلاعات آدرس
        'country',
        'province',
        'city',
        'address',
        'postal_code',
        'phone',
        'national_code',
        'avatar',
        'check_payment_active',
        'credit_payment_active',
        'credit_limit',
    ];

    protected $casts = [
        'check_payment_active' => 'boolean',
        'credit_payment_active' => 'boolean',
    ];

	public function payments()
	{
		return $this->hasMany(Payment::class);
	}

    public function credits()
    {
        return $this->hasMany(Credit::class);
    }

    public function checks()
    {
        return $this->hasMany(Check::class);
    }

	public function notifications()
	{
		return $this->hasMany(Notification::class);
	}

	public function subscribe()
	{
		return $this->hasOne(UserSubscribe::class)->whereDate('expire_at','>=',now());
	}

	public function questions()
	{
		return $this->hasMany(UserQuestion::class);
	}

    public function memberLists()
    {
        return $this->belongsToMany(MemberList::class, 'user_member_lists', 'user_id', 'member_list_id');
    }

    public function articles()
    {
        return $this->hasMany(Article::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    public function role()
    {
        return $this->belongsTo(Role::class);
    }
    public function hasRole(string $role): bool
    {
        return $this->role()->where('title', $role)->exists();
    }

    public function isAdmin(): bool
    {
        return $this->role->title === 'admin';
    }
	public function tokens()
	{
		return $this->hasMany(UserToken::class);
	}

	public function getHasSubscribeAttribute(){
		return $this->subscribe()->count() > 0;
	}

	public function getFullNameAttribute(){
		return $this->first_name . ' '. $this->last_name;
	}

    // مدل User رابطه‌ی posts را اضافه کنید
    public function posts()
    {
        return $this->hasMany(Post::class);
    }

    public function sessions()
    {
        return $this->hasMany(Session::class);
    }

    public function sentMessages()
    {
        return $this->hasMany(Message::class, 'sender_id');
    }

    public function receivedMessages()
    {
        return $this->hasMany(Message::class, 'recipient_id');
    }




    public function calculateAvailableCredit()
    {

        $totalCreditLimit = $this->credit_limit;

        $allocatedUnpaidCredits = $this->credits()->where('payment_status', 'unpaid')->sum('amount');

        $availableCredit = $totalCreditLimit - $allocatedUnpaidCredits;

        return $availableCredit;
    }

    // Calculate total order amount
    public function getTotalOrderAmount()
    {
        // Get all orders
        $orders = $this->orders()->get();

        // Initialize total order amount
        $totalOrderAmount = 0;

        // Loop through each order
        foreach ($orders as $order) {
            // Calculate total order amount for each order
            $totalOrderAmount += $order->orderItems()->sum('total');
        }

        // Return total order amount
        return $totalOrderAmount;

    }

    // Calculate number of open orders
    public function getOpenOrdersCount()
    {
        return $this->orders()->where('status', 'basket')->count();
    }

    // Calculate number of completed orders
    public function getCompletedOrdersCount()
    {
        return $this->orders()->where('status', 'completed')->count();
    }

    // Calculate number of canceled orders
    public function getCanceledOrdersCount()
    {
        return $this->orders()->where('status', 'canceled')->count();
    }


    public function lastPaidPayment()
    {
        return $this->credits()->where('payment_status', 'paid')->latest('due_date')->first();
    }


    public function nextUnpaidPaymentDueDate()
    {
        return $this->credits()
            ->where('payment_status', 'unpaid')
            ->where('due_date', '>', now())
            ->orderBy('due_date')
            ->first();
    }

    public function basket($orderStatus=null){
        $status =[];
        $total =[];
        $cartCount = 0; // Initialize cart count
        $totalPrice = 0; // Initialize total price
        $availableCreditPlan = 0;
        $items = []; // Initialize cart items array
        $attributeNames = [];
        $options = [];
        $totalDiscountPrice =0;
        $summedAmounts=[];
        if($orderStatus)
            $orders = $this->orders()->where('status', $orderStatus)->get();
        else
            $orders = $this->orders()->get();

        foreach($orders as $order){
            if($order){

                $cartItems = $order->orderItems;


                foreach ($cartItems as  $cartItem) {

                    $totalAttributePrice = 0;
                    $totalAttributeSalePrice =0;
                    $status[]= $cartItem->status;
                    // Assuming the product ID is provided as 'product'
                    $product = $cartItem->product;



                    if ($product) {

                        $attributes = $cartItem->orderProperties;
                        // Extract quantity from the item using regular expressions
                        $quantity =  $cartItem->quantity;
                        $cartCount += $quantity;

                        // Extract attribute items for the product

                        foreach($attributes as $attributeItem){

                            $priceAttr = $attributeItem->sale_price ?? $attributeItem->price ;
                            if (!is_null($priceAttr)){
                                $attributeNames[] = $attributeItem->name;
                                $totalAttributeSalePrice += $priceAttr;
                                $totalAttributePrice += $attributeItem->price ;
                                $options[] = [$attributeItem->name =>$attributeItem->value];
                            }


                        }

                        // Check if the product has a sale price
                        $price = $product->sale_price ?? $product->price;

                        $totalProductPrice= ($price + $totalAttributeSalePrice ) * $quantity;
                        $totalPrice += $totalProductPrice;


                        $credit=$product->creditInstallmentTimeline($totalProductPrice);
                        $productTimeline = $credit->timeline;

                        foreach ($productTimeline as $key => $value) {
                            // اگر مقدار مشابه وجود داشته باشد، به آن اضافه شود، در غیر این صورت ایجاد شود
                            if (isset($summedAmounts[$key])) {
                                $summedAmounts[$key] += $value->amount;
                            } else {
                                $summedAmounts[$key] = $value->amount;
                            }
                        }

                        $availableCreditPlan += $credit->totalCredit;
                        // Add product details to the items array
                        $items[] = (object)[
                            "id" => $cartItem->id,        //order id
                            "product_id" => $product->id,
                            "name" => $product->title,
                            "status" => $cartItem->status,
                            "img" => $product->img,
                            "link" => $product->link,
                            "price" => $product->price + $totalAttributePrice,
                            "sale_price"  => $product->sale_price + $totalAttributeSalePrice,
                            "discountPercentage" => $product->discountPercentage,
                            'options' => $options,
                            "quantity" => $quantity,
                            "attribute" => $attributeNames,
                            "credit" => $credit,
                            "service" => $product->service,
                            "services" =>(object) [
                                "sewing" => $product->services()->where('type', 'sewing')->first(),
                                "installer" => $product->services()->where('type', 'installer')->first(),
                                "design" => $product->services()->where('type', 'design')->first(),
                            ],
                            "installer" => $cartItem->installer ?? null,
                            "sewing" => $cartItem->sewing ?? null,
                            "design" => $cartItem->design ?? null,
                            "total" => ($product->sale_price ?? $product->price + $totalAttributeSalePrice ) * $quantity  , // Calculate total price for each item
                        ];
                    }

                }


                // ایجاد timeline کلی با مقادیر جمع شده

                $totalTimeline=$this->calculateDueDates($summedAmounts);

                $availableCreditPlan=($order->paymentMethod=='credit') ? $availableCreditPlan :0;
                $availableCheck = ($order->paymentMethod=='check') ? $order->getTotalUnpaidChecksAmount() :0;

                $deliveryCost = $this->deliveryCost($order);

                $orders =(object) [
                    "cart" =>(object) [
                        "id" => $order->id,
                        "count" => $cartCount,
                        "total" => number_format($totalPrice), // Format the total price
                        "status" => $status,
                        "orderStatus" => $order->status ,
                        'deliveryType' => $order->deliveryType ,
                        'paymentMethod' => $order->paymentMethod,
                        'deliveryCost' => $deliveryCost,
                        'availableCreditPlan' => number_format($availableCreditPlan),
                        "availableCheck"  => number_format($availableCheck),
                        'totalTimeline'  => $totalTimeline,
                        'totalCheckTimeline' => $order->checks,
                        'createdAtDate' => $this->gregorianToJalalian($order->created_at_date), // order date
                        "totalPayed" => number_format($totalPrice + $totalDiscountPrice + $deliveryCost - $availableCreditPlan -$availableCheck ),
                    ],
                    "items" => $items, // Add items to the response
                ];
            }
            else{
                $orders =(object) [
                    "cart" =>(object) [
                        "count" => $cartCount,
                        "total" => 0, // Format the total price
                        "status" => [],
                        "orderStatus" => $order->status ,
                        'deliveryType' => 'cash' ,
                        'paymentMethod' => 'cash',
                        'deliveryCost' => 0,
                        'availableCreditPlan' => 0,
                        "availableCheck"  => 0,
                        'totalTimeline'  => [],
                        'totalCheckTimeline' => [],
                        'createdAtDate' => '',
                        "totalPayed" => 0,
                    ],
                    "items" => [], // Add items to the response
                ];
            }

            $total[]=$orders;
        }
        return $total;
    }




    public function getOrdersByStatus($status)
    {
        return $this->basket($status);
    }

    public function getBasketOrders()
    {
        return $this->getOrdersByStatus('basket');
    }

    public function getPendingOrders()
    {
        return $this->getOrdersByStatus('pending');
    }

    public function getProcessingOrders()
    {
        return $this->getOrdersByStatus('processing');
    }

    public function getCompletedOrders()
    {
        return $this->getOrdersByStatus('completed');
    }

    public function getCanceledOrders()
    {
        return $this->getOrdersByStatus('canceled');
    }

    public function getRejectOrders()
    {
        return $this->getOrdersByStatus('reject');
    }


    public function existsProductReview($productId)
    {
        // Check if a review exists for the given user_id and product_id
        return $this->reviews()->where('product_id', $productId)->exists();
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

    public function creditPlans()
    {
        return $this->belongsToMany(CreditPlan::class, 'credit_plan_user');
    }

    public function loginSessions()
    {
        return $this->hasMany(LoginSession::class);
    }

    // رابطه‌ی بسیار به بسیار با تخفیف‌ها
    public function discountCodes()
    {
        return $this->belongsToMany(DiscountCode::class, 'discount_user', 'user_id', 'discount_code_id');
    }

    // تعریف رابطه با مدل TransportRegion
    public function transportRegions()
    {
        return $this->hasMany(TransportRegion::class);
    }

    public function activeServices()
    {
        return $this->hasMany(ServiceDetail::class);
    }

    public function worktimes()
    {
        return $this->hasMany(Worktime::class);
    }

    public function getCurrentMonthTotalHours()
    {
        $currentJalaliMonth = Jalalian::now();

        // استخراج سال و ماه شمسی
        $year = $currentJalaliMonth->getYear();
        $month = $currentJalaliMonth->getMonth();

        // تعیین تعداد روزهای ماه جاری
        $daysInMonth = 30; // پیش فرض برای ماه‌های 30 روزه
        if ($month <= 6) {
            $daysInMonth = 31; // ماه‌های 31 روزه (فروردین تا شهریور)
        } elseif ($month == 12) {
            $daysInMonth = $currentJalaliMonth->isLeapYear() ? 30 : 29; // اسفند ماه (سال کبیسه یا غیر کبیسه)
        }

        if ($month < 10) {
            $month = "0" . $month;
        }

        // تاریخ شروع ماه جاری (اولین روز ماه شمسی)
        $startOfMonthJalali = Jalalian::fromFormat('Y-m-d', "$year-$month-01");
        $startOfMonth = $startOfMonthJalali->toCarbon()->toDateString();

        // تاریخ پایان ماه جاری (آخرین روز ماه شمسی)
        $endOfMonthJalali = Jalalian::fromFormat('Y-m-d', "$year-$month-$daysInMonth");
        $endOfMonth = $endOfMonthJalali->toCarbon()->toDateString();

        return $this->worktimes()
                    ->whereBetween('date', [$startOfMonth, $endOfMonth])
                    ->sum('hours');
    }




}
