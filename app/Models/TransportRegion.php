<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransportRegion extends Model
{
    use HasFactory;


    protected $fillable = [
        'title',
        'regions',
        'cost_type',
        'price',
    ];

    protected $casts = [
        'regions' => 'array',
    ];
}
