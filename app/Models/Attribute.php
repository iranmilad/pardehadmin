<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class Attribute extends Model
{

    protected $fillable = [
        'name', 'countable', 'unit', 'display_type', 'guide_link',
    ];

    public function items()
    {
        return $this->hasMany(AttributeItem::class);
    }

    public function products()
    {
        return $this->belongsToMany(Product::class, 'attribute_product', 'attribute_id', 'product_id');
    }

    public function findItemByName($itemName)
    {
        return $this->items()->where('name', $itemName)->first();
    }

}
