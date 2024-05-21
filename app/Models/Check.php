<?php

namespace App\Models;

use Morilog\Jalali\Jalalian;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Check extends Model
{
    use HasFactory;

    protected $fillable = ['amount', 'check_number', 'due_date', 'payment_status', 'user_id', 'order_id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }


    public function order()
    {
        return $this->belongsTo(Order::class);
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
