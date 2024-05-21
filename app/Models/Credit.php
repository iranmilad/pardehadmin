<?php

namespace App\Models;

use Morilog\Jalali\Jalalian;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Credit extends Model
{
    use HasFactory;

    protected $fillable = ['amount', 'due_date', 'payment_status', 'order_id', 'product_id', 'user_id', 'payment_id'];
    // ارتباط اعتبار با یک کاربر
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // ارتباط اعتبار با یک سفارش
    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function payment()
    {
        return $this->belongsTo(Payment::class);
    }

    /**
     * Convert due date from Gregorian to Jalali (Shamsi).
     *
     * @return string
     */
    public function getDueDateShamsiAttribute()
    {
        // Parse the Gregorian date
        $gregorianDate = \Carbon\Carbon::parse($this->due_date);

        // Convert to Jalali (Shamsi)
        $jalaliDate = Jalalian::fromCarbon($gregorianDate);

        // Format the date as desired
        return $jalaliDate->format('Y/m/d');
    }

}
