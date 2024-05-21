<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CreditPlanProduct extends Model
{
    use HasFactory;
    protected $fillable = ['credit_plan_id', 'product_id'];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function creditPlan()
    {
        return $this->belongsTo(CreditPlan::class);
    }
}
