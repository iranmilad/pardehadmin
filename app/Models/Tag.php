<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'description','type'];

    public function products()
    {
        return $this->belongsToMany(Product::class);
    }

    public function filters()
    {
        return $this->hasMany(Filter::class);
    }

    public function posts()
    {
        return $this->belongsToMany(Post::class);
    }

    public function getLinkAttribute()
    {
        return "/search/tag/".$this->name;
    }
}
