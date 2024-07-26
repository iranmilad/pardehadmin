<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GroupCreditLimit extends Model
{
    use HasFactory;
    protected $fillable = [
        'group_id',
        'title',
        'min_score',
        'max_score',
    ];

    public function group()
    {
        return $this->belongsTo(Group::class);
    }
}
