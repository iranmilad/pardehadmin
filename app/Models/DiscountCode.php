<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DiscountCode extends Model
{
    use HasFactory;

    protected $fillable = [
        'code',
        'discount_amount',
        'is_used',
        'usage_type',
        'usage_limit',
        'usage_count',
    ];

    public function orders()
    {
        return $this->hasMany(Order::class);
    }

}
