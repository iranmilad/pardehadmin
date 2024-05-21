<?php

namespace App\Models;

use App\Models\SliderImage;
use Illuminate\Database\Eloquent\Model;


class Slider extends Model
{


    public function images()
    {
        return $this->hasMany(SliderImage::class);
    }
}
