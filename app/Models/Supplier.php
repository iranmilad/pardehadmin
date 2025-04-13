<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'name',
        'payment_type',
        'delivery_areas',
        'buy_type',
        'sku',
        'price',
        'sale_price',
        'wholesale_price',
        'few',
        'fewspd',
        'fewtak',
        'holo_code',
        'min_order',
        'max_order',
        'rating',
        'holo_sku',
        'product_combinations',
        'is_special',
        'special_time',
    ];

    protected $casts = [
        'is_special' => 'boolean',
        'regions' => 'array'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // رابطه با جدول ProductAttributeCombination (در صورتی که برای ترکیب‌ها قیمت یا اطلاعات دیگری داشته باشد)
    public function productCombinations()
    {
        return $this->hasMany(ProductAttributeCombination::class);
    }

    // رابطه با جدول ProductSupplier (برای مدیریت ارتباط بین تامین‌کننده‌ها و محصولات)
    public function productSuppliers()
    {
        return $this->hasMany(ProductSupplier::class);
    }

    public function reviews()
    {
        return $this->hasMany(SupplierReview::class);
    }

    public function averageRating()
    {
        return $this->reviews()->avg('rating');
    }

    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }

}
