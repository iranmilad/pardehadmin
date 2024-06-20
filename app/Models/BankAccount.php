<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BankAccount extends Model
{
    use HasFactory;
    protected $fillable = ['gateway_id', 'bankname', 'accountnumber', 'cardnumber'];

    public function gateway()
    {
        return $this->belongsTo(Gateway::class);
    }
}
