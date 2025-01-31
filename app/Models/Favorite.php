<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Favorite extends Model
{
    use HasFactory;
    protected $fillable = ['user_id', 'product_id'];

    /**
     * تعریف ارتباط با مدل کاربر
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * تعریف ارتباط با مدل محصول
     */
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
