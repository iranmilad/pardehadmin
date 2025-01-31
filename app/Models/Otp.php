<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Otp extends Model
{
    use HasFactory;

    /**
     * نام جدول
     *
     * @var string
     */
    protected $table = 'otps';

    /**
     * فیلدهای قابل پر کردن
     *
     * @var array
     */
    protected $fillable = [
        'phone_number',
        'otp',
        'expires_at',
    ];

    /**
     * نوع داده‌های برخی از ستون‌ها
     *
     * @var array
     */
    protected $casts = [
        'expires_at' => 'datetime',
    ];
}
