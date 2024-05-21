<?php

namespace App\Models;

use AttributeItem;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Variation extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_id',
        'attribute_item_id',
        'price',
        'sale_price',
        'wholesale_price',
        'few',
        'fewspd',
        'fewtak',
        'holo_code',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function attributeItem()
    {
        return $this->belongsTo(AttributeItem::class);
    }
}
