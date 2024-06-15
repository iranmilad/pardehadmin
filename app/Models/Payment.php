<?php

namespace App\Models;

use Morilog\Jalali\Jalalian;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

 class Payment extends Model
{
	use SoftDeletes;
	protected $fillable=["id","gu_id","user_id","reference_id","ref_id","amount","state","type"];

	public function user()
	{
		return $this->belongsTo(User::class);
	}

	public function order()
	{
		return $this->belongsTo(Order::class);
	}


    /**
     * Convert payed date from Gregorian to Jalali (Shamsi).
     *
     * @return string
     */
    public function getPayedDateShamsiAttribute()
    {
        // Parse the Gregorian date
        $gregorianDate = \Carbon\Carbon::parse($this->update_at);

        // Convert to Jalali (Shamsi)
        $jalaliDate = Jalalian::fromCarbon($gregorianDate);

        // Format the date as desired
        return $jalaliDate->format('Y/m/d');
    }

}
