<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'description'];

    public function users()
    {
        return $this->belongsToMany(User::class, 'group_user');
    }

    public function creditLimits()
    {
        return $this->hasMany(GroupCreditLimit::class, 'group_id', 'id');
    }

    public function discountCodes()
    {
        return $this->belongsToMany(DiscountCode::class, 'discount_group', 'group_id', 'discount_code_id');
    }

    public function creditPlans()
    {
        return $this->belongsToMany(CreditPlan::class, 'credit_plan_group', 'group_id', 'credit_plan_id');
    }
}
