<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Property extends Model
{
    protected $fillable = [
        'attribute_id', 'value','img','description'
    ];

    public function attribute()
    {
        return $this->belongsTo(Attribute::class);
    }

    public function products()
    {
        return $this->belongsToMany(Product::class, 'product_attribute_property')
                    ->withPivot('attribute_id', 'value','name', 'details', 'max_value', 'min_value', 'unit_factor', 'unit_description', 'conversion_factor', 'base_unit', 'img', 'attribute_id','delivery_unit_time','delivery_time');
    }

    public function attributeCombinations()
    {
        return $this->hasMany(ProductAttributeCombination::class);
    }

    public function attributeProperties()
    {
        return $this->hasMany(ProductAttributeProperty::class);
    }

}
