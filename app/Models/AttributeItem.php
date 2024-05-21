<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AttributeItem extends Model
{

    protected $fillable = [
        'name', 'details', 'max_value', 'min_value', 'unit_factor', 'unit_description', 'conversion_factor', 'base_unit', 'img', 'attribute_id','delivery_unit_time','delivery_time',
    ];

    public function attribute()
    {
        return $this->belongsTo(Attribute::class);
    }

    public function getTotalTime($usage=1)
    {
        if ($this->delivery_time=="fix") {

            return $this->delivery_unit_time;
        }
        else{

            return $usage * $this->delivery_unit_time;

        }
    }

}
