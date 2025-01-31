<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductSupplier extends Model
{
    use HasFactory;

    protected $table = 'product_supplier';

    protected $fillable = [
        'product_id',
        'supplier_id',
        'combination_id',
    ];

    // ارتباط با مدل‌های محصول و تامین‌کننده
    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function supplier()
    {
        return $this->belongsTo(Supplier::class);
    }

    // ارتباط با ترکیب‌های ویژگی‌های محصول
    public function combination()
    {
        return $this->belongsTo(ProductAttributeCombination::class, 'combination_id');
    }

}
