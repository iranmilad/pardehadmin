<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CreditScore extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'positive_payment',
        'on_time_payment',
        'sales_score',
        'delayed_payment',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
