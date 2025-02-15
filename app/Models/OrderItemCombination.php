<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderItemCombination extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_item_id',
        'combination_id',
    ];

    public function orderItem()
    {
        return $this->belongsTo(OrderItem::class);
    }

    public function combination()
    {
        return $this->belongsTo(ProductAttributeCombination::class);
    }

    public function suppliers()
    {
        return $this->hasMany(Supplier::class, 'product_combination_id');
    }

}
