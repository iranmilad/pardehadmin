<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductPriceHistory extends Model
{
    use HasFactory;
    protected $fillable = ['product_id', 'date', 'min_price', 'max_price'];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

}
