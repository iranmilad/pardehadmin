<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    use HasFactory;
    protected $fillable = ['title', 'content', 'user_id', 'status', 'url', 'summary', 'keywords'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
