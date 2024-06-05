<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Attribute extends Model
{
    protected $fillable = [
        'name', 'countable', 'unit', 'display_type', 'guide_link','independent'
    ];

    public function items()
    {
        return $this->hasMany(AttributeItem::class);
    }

    public function properties()
    {
        return $this->hasMany(Property::class);
    }

    public function products()
    {
        return $this->belongsToMany(Product::class, 'product_attribute_property')
                    ->withPivot('property_id', 'value','name', 'details', 'max_value', 'min_value', 'unit_factor', 'unit_description', 'conversion_factor', 'base_unit', 'img', 'attribute_id','delivery_unit_time','delivery_time');
    }

    public function findItemByName($itemName)
    {
        return $this->items()->where('name', $itemName)->first();
    }

    public function countProducts()
    {
        return $this->products()->count();
    }

    public function countItems()
    {
        return $this->items()->count();
    }


    public function attributeProperties()
    {
        return $this->hasMany(ProductAttributeProperty::class);
    }
}
