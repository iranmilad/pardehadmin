<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_id',
        'type',
        'category_id',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    
    // رابطه جدید برای اتصال به جزئیات سرویس
    public function serviceDetails()
    {
        return $this->hasMany(ServiceDetail::class);
    }

}
