<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SupplierReview extends Model
{
    use HasFactory;
    protected $fillable = [
        'supplier_id',
        'user_id',
        'title',
        'text',
        'rating',
        'quality',
        'service',
        'price',
        'images',
        'status',
    ];

    protected $casts = [
        'images' => 'array',
    ];

    protected static function boot()
    {
        parent::boot();

        static::saving(function ($review) {
            $review->images = json_encode($review->images);
        });

        static::retrieved(function ($review) {
            $review->images = json_decode($review->images, true);
        });
    }

    public function supplier()
    {
        return $this->belongsTo(Supplier::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public static function averageRating($supplierId)
    {
        return static::where('supplier_id', $supplierId)->avg('rating');
    }

    public function getDateShamsiAttribute()
    {
        $gregorianDate = \Carbon\Carbon::parse($this->created_at);
        $jalaliDate = \Morilog\Jalali\Jalalian::fromCarbon($gregorianDate);
        return $jalaliDate->format('Y/m/d');
    }
}
