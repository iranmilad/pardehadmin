<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'title', 'content', 'slug', 'image', 'summary', 'keywords',
        'views', 'published', 'comments_enabled', 'user_id'
    ];

    public function categories()
    {
        return $this->belongsToMany(PostCategory::class, 'post_category_post', 'post_id', 'post_category_id');
    }


    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function commentsCount()
    {
        return $this->comments()->count();
    }

    public function getDateShamsiAttribute()
    {
        $gregorianDate = \Carbon\Carbon::parse($this->due_date);
        $jalaliDate = \Morilog\Jalali\Jalalian::fromCarbon($gregorianDate);
        return $jalaliDate->format('Y/m/d');
    }

    public function getLinkAttribute()
    {
        return "/blog/".$this->slug;
    }
}
