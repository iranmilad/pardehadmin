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
        return $this->belongsToMany(Product::class, 'credit_plan_products', 'credit_plan_id', 'product_id');
    }

    public function users()
    {
        return $this->belongsToMany(User::class, 'credit_plan_user');
    }
    public function groups()
    {
        return $this->belongsToMany(Group::class, 'credit_plan_group');
    }
    public function allowedUsers()
    {
        return $this->belongsToMany(User::class, 'credit_plan_user', 'credit_plan_id', 'user_id');
    }

    public function allowedGroups()
    {
        return $this->belongsToMany(Group::class, 'credit_plan_group', 'credit_plan_id', 'user_id');
    }


}
