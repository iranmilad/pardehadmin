<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    protected $perPage = 10;
    protected $fillable = [
        'title',
        'text',
        'rating',
        'name',
        'quality',
        'performance',
        'design',
        'price',
        'ease_of_use',
        'images',
        'user_id',
        'product_id',
    ];
    protected $casts = [
        // تعیین نوع داده‌ها
        'images' => 'array',
    ];

    protected static function boot()
    {
        parent::boot();

        // قبل از ذخیره‌سازی، تبدیل داده‌های عکس‌ها به JSON
        static::saving(function ($review) {
            $review->images = json_encode($review->images);
        });

        // بعد از خواندن از دیتابیس، تبدیل داده‌های عکس‌ها به آرایه
        static::retrieved(function ($review) {
            $review->images = json_decode($review->images, true);
        });
    }

    public static function overallRatingAverage($productId)
    {
        return static::where('product_id', $productId)->avg('rating');
    }


    public static function qualityRatingAverage($productId)
    {
        return static::where('product_id', $productId)->avg('quality');
    }

    public static function performanceRatingAverage($productId)
    {
        return static::where('product_id', $productId)->avg('performance');
    }

    public static function designRatingAverage($productId)
    {
        return static::where('product_id', $productId)->avg('design');
    }

    public static function priceRatingAverage($productId)
    {
        return static::where('product_id', $productId)->avg('price');
    }

    public static function easeOfUseRatingAverage($productId)
    {
        return static::where('product_id', $productId)->avg('ease_of_use');
    }

    public function product()
    {
        $this->belongsTo(Product::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }


}
