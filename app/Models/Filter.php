<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Filter extends Model
{
    use HasFactory;


    // تعریف خصوصیات فیلتر‌ها
    protected $fillable = ['name', 'description', 'type', 'menu_id', 'tag_id'];

    // تعریف رابطه چند به چند با جدول گروه‌بندی
    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }



    public function menu()
    {
        return $this->belongsTo(Menu::class);
    }

    public function tag()
    {
        return $this->belongsTo(Tag::class);
    }

}
