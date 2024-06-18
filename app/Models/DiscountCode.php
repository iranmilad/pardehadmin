<?php

namespace App\Models;

use Morilog\Jalali\Jalalian;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class DiscountCode extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'code',
        'discount_amount',
        'discount_type',
        'is_used',
        'usage_type',
        'usage_limit',
        'usage_count',
        'discount_expire_start',
        'discount_expire_end',
        'min_amount',
        'max_amount',
        'except_special_products',
        'allowed_products',
        'disallowed_products',
        'allowed_products',
        'disallowed_products',
        'allowed_categories',
        'disallowed_categories',
        'usage_limit_per_user',
        'status',
    ];

    protected $casts = [
        'is_used' => 'boolean',
        'except_special_products' => 'boolean',
        'usage_limit' => 'integer',
        'usage_count' => 'integer',
    ];

    public function orders()
    {
        return $this->hasMany(Order::class);
    }


    public function allowedUsers()
    {
        return $this->belongsToMany(User::class, 'user_discount_code', 'discount_code_id', 'user_id');
    }

    // رابطه‌ی بسیار به بسیار با محصولات
    public function allowedProducts()
    {
        return $this->belongsToMany(Product::class, 'discount_product', 'discount_code_id', 'product_id');
    }

    // رابطه‌ی بسیار به بسیار با دسته‌های محصولات
    public function allowedCategories()
    {
        return $this->belongsToMany(Category::class, 'discount_category', 'discount_code_id', 'category_id');
    }

    /**
     * تبدیل تاریخ شروع تخفیف به تاریخ شمسی
     *
     * @return string
     */
    public function getDiscountExpireStartShamsiAttribute()
    {
        if ($this->discount_expire_start) {
            return Jalalian::fromCarbon(\Carbon\Carbon::parse($this->discount_expire_start))->format('Y/m/d');
        }
        return null;
    }

    /**
     * تبدیل تاریخ پایان تخفیف به تاریخ شمسی
     *
     * @return string
     */
    public function getDiscountExpireEndShamsiAttribute()
    {
        if ($this->discount_expire_end) {
            return Jalalian::fromCarbon(\Carbon\Carbon::parse($this->discount_expire_end))->format('Y/m/d');
        }
        return null;
    }


    // متد ذخیره‌سازی تخفیف جدید
    public static function createDiscount($data)
    {
        return self::create($data);
    }

    // متد به‌روزرسانی تخفیف
    public function updateDiscount($data)
    {
        $this->update($data);
    }

    // متد حذف تخفیف
    public function deleteDiscount()
    {
        DB::beginTransaction();

        try {
            // حذف رابطه با کاربران
            $this->allowedUsers()->detach();

            // حذف رابطه با محصولات
            $this->allowedProducts()->detach();

            // حذف رابطه با دسته‌های محصولات
            $this->allowedCategories()->detach();

            // حذف خود تخفیف
            $this->delete();

            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            throw $e;
        }
    }

    // متد بررسی استفاده تخفیف
    public function isUsed()
    {
        return $this->is_used;
    }


}
