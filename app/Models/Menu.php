<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    protected $fillable = ['title', 'link', 'icon', 'alias', 'show_title', 'menu_id'];

    public function parentMenu()
    {
        return $this->belongsTo(Menu::class, 'menu_id');
    }

    public function childMenus()
    {
        return $this->hasMany(Menu::class, 'menu_id');
    }

    public function filters()
    {
        return $this->hasMany(Filter::class);
    }

    public function products()
    {
        return $this->hasManyThrough(Product::class, Category::class);
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class, 'category_menu', 'menu_id', 'category_id');
    }

}
