<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ImageMarker extends Model
{
    use HasFactory;

    protected $fillable = ['image_path', 'marks'];

    protected $casts = [
        'marks' => 'array',
    ];
}
