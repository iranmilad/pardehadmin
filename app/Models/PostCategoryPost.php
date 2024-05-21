<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PostCategoryPost extends Model
{
    use HasFactory;

    protected $table = 'post_category_post';

    protected $fillable = [
        'post_id',
        'post_category_id',
    ];

    public function post()
    {
        return $this->belongsTo(Post::class);
    }

    public function category()
    {
        return $this->belongsTo(PostCategory::class, 'post_category_id');
    }
}
