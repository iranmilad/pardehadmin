<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class Comment extends Model
{
    protected $perPage = 5;

    protected $fillable = [
        'name', 'email', 'user_id', 'post_id', 'text'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function post()
    {
        return $this->belongsTo(Post::class);
    }

    // افزودن رابطه‌ی بین نظرات
    public function parentComment()
    {
        return $this->belongsTo(Comment::class, 'parent_comment_id');
    }

    public function replies()
    {
        return $this->hasMany(Comment::class, 'parent_comment_id');
    }

    public function getForPost(Post $post, int $offset = 0)
    {
        return $this
            ->wherePostId($post->id)
            ->with('user')
            ->orderByDesc('id')
            ->take($this->perPage)
            ->offset($offset * $this->perPage)
            ->get();
    }

    public function getMaxOffset(Post $post): float
    {
        return $post->comments->count() / $this->perPage;
    }
}
