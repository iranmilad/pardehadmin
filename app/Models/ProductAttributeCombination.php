<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

class ProductAttributeCombination extends Model
{
    use HasFactory;
    protected $fillable = [
        'product_id','independent','holo_code', 'price','sale_price','wholesale_price', 'stock_quantity', 'description', 'img'
    ];

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



}
