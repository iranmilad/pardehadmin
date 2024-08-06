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

    public function allowedGroups()
    {
        return $this->belongsToMany(Group::class, 'discount_group', 'discount_code_id', 'group_id');
    }

    public function allowedUsers()
    {
        return $this->belongsToMany(User::class, 'user_discount_code', 'discount_code_id', 'user_id');
    }

    public function allowedProducts()
    {
        return $this->belongsToMany(Product::class, 'discount_product', 'discount_code_id', 'product_id');
    }

    public function allowedCategories()
    {
        return $this->belongsToMany(Category::class, 'discount_category', 'discount_code_id', 'category_id');
    }

    public function getDiscountExpireStartShamsiAttribute()
    {
        if ($this->discount_expire_start) {
            return Jalalian::fromCarbon(\Carbon\Carbon::parse($this->discount_expire_start))->format('Y/m/d');
        }
        return null;
    }

    public function getDiscountExpireEndShamsiAttribute()
    {
        if ($this->discount_expire_end) {
            return Jalalian::fromCarbon(\Carbon\Carbon::parse($this->discount_expire_end))->format('Y/m/d');
        }
        return null;
    }

    public static function createDiscount($data)
    {
        return self::create($data);
    }

    public function updateDiscount($data)
    {
        $this->update($data);
    }

    public function deleteDiscount()
    {
        DB::beginTransaction();

        try {
            $this->allowedUsers()->detach();
            $this->allowedProducts()->detach();
            $this->allowedCategories()->detach();
            $this->allowedGroups()->detach();

            $this->delete();

            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            throw $e;
        }
    }

    public function isUsed()
    {
        return $this->is_used;
    }

}
