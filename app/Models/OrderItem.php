<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    use HasFactory;


    protected $fillable = [
        'id',
        'order_id',
        'product_id',
        'quantity',
        'installer',
        'designer',
        'sewing',
        'price',
        'sale_price',
        'total',
        'item_type',
        'status',
    ];

    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
    public function combinations()
    {
        return $this->belongsToMany(ProductAttributeCombination::class, 'order_item_combinations', 'order_item_id', 'combination_id');
    }

    public function getCombinationAttributesProperties()
    {
        $combinations = $this->combinations()->with('attributeProperties.property', 'attributeProperties.attribute')->get();

        $result = [];

        foreach ($combinations as $combination) {
            foreach ($combination->attributeProperties as $property) {
                $result[] = [
                    'combination_id' => $combination->id,
                    'attribute_id' => $property->attribute->id,
                    'attribute_name' => $property->attribute->name,
                    'property_id' => $property->property->id,
                    'property_value' => $property->property->value,
                    'independent' => $combination->independent,
                    'holo_code' => $combination->holo_code,
                    'price' => $combination->price,
                    'sale_price' => $combination->sale_price,
                    'wholesale_price' => $combination->wholesale_price,
                    'stock_quantity' => $combination->stock_quantity,
                    'description' => $combination->description,
                    'img' => $combination->img
                ];
            }
        }

        return collect($result);
    }
}
