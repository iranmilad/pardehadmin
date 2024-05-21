<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CreditPlan extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'credit_percentage', 'installments_count', 'installment_percentage', 'installment_interval_months'];


    public function products()
    {
        return $this->belongsToMany(Product::class);
    }


}
