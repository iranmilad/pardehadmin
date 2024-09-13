<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_id',
        'type',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class, 'category_service');
    }

}
