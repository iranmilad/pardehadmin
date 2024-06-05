<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductAttributeProperty extends Model
{
    use HasFactory;

    protected $table = 'product_attribute_property';


    protected $fillable = [
        'product_id', 'attribute_id', 'property_id', 'combination_id'
    ];



    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function attribute()
    {
        return $this->belongsTo(Attribute::class);
    }

    public function property()
    {
        return $this->belongsTo(Property::class);
    }
    public function combination()
    {
        return $this->belongsTo(ProductAttributeCombination::class, 'combination_id');
    }

}
