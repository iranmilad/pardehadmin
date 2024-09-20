<?php

namespace App\Models;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ProductAttributeCombination extends Model
{
    use HasFactory;
    protected $fillable = [
        'product_id','independent','holo_code', 'price','sale_price','wholesale_price', 'stock_quantity', 'description', 'img','time_per_unit'
    ];

    /**
     * Accessor for sale_price.
     * If the user has the 'wholesale' role, return wholesale_price instead of sale_price.
     *
     * @return float|null
     */
    public function getSalePriceAttribute()
    {
        // Check if the user is logged in and has the 'wholesale' role
        if (Auth::check() && Auth::user()->hasRole('wholesale')) {

            return $this->wholesale_price ?? $this->attributes['sale_price'];
        }

        // Otherwise, return the regular sale price
        return $this->attributes['sale_price'];
    }




    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function attributeProperties()
    {
        return $this->hasMany(ProductAttributeProperty::class, 'combination_id');
    }

    public function orderItems()
    {
        return $this->belongsToMany(OrderItem::class, 'order_item_combinations', 'combination_id', 'order_item_id');
    }
    /**
     * Check if a given property_id exists in one of the attributes for this combination.
     *
     * @param int $propertyId
     * @return bool
     */
    public function hasProperty($propertyId)
    {
        return $this->attributeProperties()->where('property_id', $propertyId)->exists();
    }

    public function selectedProperties()
    {
        $properties = $this->attributeProperties()->with(['property:id,value', 'attribute:id,name'])->get();

        $result = [];

        foreach ($properties as $property) {
            $result[] = [
                'id' => $property->property->id,
                'value' => $property->property->value,
                'attribute_name' => $property->attribute->name,
                'attribute_id' => $property->attribute->id
            ];
        }

        return collect($result);
    }

    public function properties()
    {
        return $this->belongsToMany(Property::class, 'product_attribute_property', 'combination_id', 'property_id');
    }



}
