<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PostCategory extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'parent_id'];

    public function posts()
    {
        return $this->belongsToMany(Post::class, 'post_category_post', 'post_category_id', 'post_id');
    }

    public function getTotalPostsAttribute()
    {
        return $this->posts()->count();
    }

    public function getLinkAttribute()
    {
        $nameWithHyphen = str_replace(' ', '-', $this->name);
        return "/search/category/{$nameWithHyphen}";
    }

    // Accessor برای دریافت slug
    public function getSlugAttribute()
    {
        return str_replace(' ', '-', $this->name);
    }

    // Accessor برای دریافت description
    public function getDescriptionAttribute()
    {
        return $this->attributes['name'];
    }

    // Define parent-children relationship
    public function parent()
    {
        return $this->belongsTo(PostCategory::class, 'parent_id');
    }

    public function children()
    {
        return $this->hasMany(PostCategory::class, 'parent_id');
    }

}
