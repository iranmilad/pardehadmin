<?php

namespace App\Models;

use App\Models\Article;
use Morilog\Jalali\Jalalian;
use Illuminate\Database\Eloquent\Model;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable implements JWTSubject
{
     use HasFactory, Notifiable;

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
        'role_id',
    ];

    protected $casts = [
        'check_payment_active' => 'boolean',
        'credit_payment_active' => 'boolean',
    ];

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    public function getJWTCustomClaims()
    {
        return [];
    }

    // Define the relationship with the Product model
    public function products()
    {
        return $this->hasMany(Product::class);
    }

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
        return $this->role->title !== 'user';
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

        $total =[];
        if($orderStatus)
            $orders = $this->orders()->where('status', $orderStatus)->get();
        else
            $orders = $this->orders()->get();

        foreach($orders as $order){
            $total[]= $order->basket();;
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

    public function groups()
    {
        return $this->belongsToMany(Group::class, 'group_user');
    }

    public function creditScore()
    {
        return $this->hasOne(CreditScore::class);
    }

    // فرض بر این است که مدل User مربوط به جدول users است و شامل روابط لازم برای نقش‌ها و پرمیشن‌ها می‌باشد.
    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }

    /**
     * بررسی دسترسی برای یک کد دسترسی خاص
     *
     * @param string $permissionName
     * @param string $type
     * @return bool
     */
    public function hasPermission($permissionName, $type = 'read_own')
    {

        if ($this->role->hasPermission($permissionName, $type)) {
            return true;
        }

        return false;
    }

    /**
     * بررسی دسترسی خواندن
     *
     * @param string $permissionName
     * @return bool
     */
    public function hasReadPermission($permissionName)
    {
        return $this->hasPermission($permissionName, 'read_own');
    }

    /**
     * بررسی دسترسی نوشتن
     *
     * @param string $permissionName
     * @return bool
     */
    public function hasWritePermission($permissionName)
    {
        return $this->hasPermission($permissionName, 'write_own');
    }

    public function favorites()
    {
        return $this->hasMany(Favorite::class);
    }

    public function suppliers()
    {
        return $this->hasMany(Supplier::class);
    }

    public function supplierReviews()
    {
        return $this->hasMany(SupplierReview::class);
    }



}
