<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderProperty extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_item_id',
        'property_id',
        'name',
        'value',
        'price',
        'sale_price',
        'total',
    ];

    public function orderItem()
    {
        return $this->belongsTo(OrderItem::class);
    }

    public function property()
    {
        return $this->belongsTo(Property::class);
    }
}
