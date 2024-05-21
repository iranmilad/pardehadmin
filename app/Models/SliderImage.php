<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SliderImage extends Model
{
    use HasFactory;


    protected $fillable = ['slider_id', 'image', 'hover_image', 'link', 'title', 'caption', 'alt'];

    public function slider()
    {
        return $this->belongsTo(Slider::class);
    }

}
