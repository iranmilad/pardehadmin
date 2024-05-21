<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderAttributeItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_item_id',
        'attribute_item_id',
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

    public function attributeItem()
    {
        return $this->belongsTo(AttributeItem::class);
    }
}
