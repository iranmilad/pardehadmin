<?php

namespace App\Models;

use Morilog\Jalali\Jalalian;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class WorkTime extends Model
{
    use HasFactory;
    protected $fillable = ['user_id', 'date', 'hours'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getDateShamsiAttribute()
    {
        $gregorianDate = \Carbon\Carbon::parse($this->date);
        $jalaliDate = \Morilog\Jalali\Jalalian::fromCarbon($gregorianDate);
        return $jalaliDate->format('Y/m/d');
    }
}
