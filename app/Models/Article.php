<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class Article extends Model
{
    protected $perPage = 3;

    protected $fillable = [
        'specification', 'guide', 'video', 'product_id', 'description'
    ];

    public function getImgAttribute(string $value): string
    {
        return '/images/posts/' . $value;
    }


    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function getLastForMainPage()
    {
        return $this
            ->with('user')
            ->withCount('comments')
            ->orderByDesc('id')
            ->take(3)
            ->get();
    }

    public function getForBlog()
    {
        return $this
            ->with('user')
            ->withCount('comments')
            ->orderByDesc('id')
            ->paginate();
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }





}
