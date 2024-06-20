<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Gateway extends Model
{
    use SoftDeletes;

    protected $fillable = ['title', 'type', 'merchant_code', 'success_message', 'failure_message', 'logo','is_active'];

    public function bankAccounts()
    {
        return $this->hasMany(BankAccount::class);
    }

    public function payments()
    {
        return $this->hasMany(Payment::class);
    }


}
