<?php

namespace App\Models;

use Morilog\Jalali\Jalalian;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Session extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'priority', 'member_list_id', 'user_id'];

    public function memberList()
    {
        return $this->belongsTo(MemberList::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function messages()
    {
        return $this->hasMany(Message::class);
    }

    /**
     * Convert Create At date from Gregorian to Jalali (Shamsi).
     *
     * @return string
     */
    public function getCreateAtShamsiAttribute()
    {
        // Parse the Gregorian date
        $gregorianDate = \Carbon\Carbon::parse($this->create_at);

        // Convert to Jalali (Shamsi)
        $jalaliDate = Jalalian::fromCarbon($gregorianDate);

        // Format the date as desired
        return $jalaliDate->format('Y/m/d');
    }


}
