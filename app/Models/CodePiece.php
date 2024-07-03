<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CodePiece extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'url', 'placement', 'priority', 'code', 'status'];
}
