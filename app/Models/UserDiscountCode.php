<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\DiscountCode;

class UserDiscountCode extends Model
{
    protected $table = 'user_discount_code';

    protected $fillable = [
        'user_id',
        'discount_code_id',
    ];

    /**
     * رابطه با مدل User
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * رابطه با مدل DiscountCode
     */
    public function discountCode()
    {
        return $this->belongsTo(DiscountCode::class, 'discount_code_id');
    }

    /**
     * بازگرداندن اطلاعات کاربر به صورت فرمت‌دار
     *
     * @return array
     */
    public function getFormattedUser()
    {
        if ($this->user) {
            return [
                'id' => $this->user->id,
                'name' => "{$this->user->first_name} {$this->user->last_name}",
                'email' => $this->user->email,
            ];
        }
        return null;
    }

    /**
     * بازگرداندن اطلاعات کد تخفیف به صورت فرمت‌دار
     *
     * @return array
     */
    public function getFormattedDiscountCode()
    {
        if ($this->discountCode) {
            return [
                'id' => $this->discountCode->id,
                'code' => $this->discountCode->code,
                'title' => $this->discountCode->title,
            ];
        }
        return null;
    }
}
