<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    protected $fillable = ['title', 'link', 'icon', 'alias', 'show_title', 'menu_id','block_widget_id'];

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

    public function blockWidget()
    {
        return $this->belongsTo(BlockWidget::class, 'block_widget_id');
    }

    public static function mainMenu()
    {
        // دریافت منوهای اصلی که دارای فرزند هستند
        $menus = Menu::where(["alias"=>'main_menu'])->whereNull('menu_id')->with(['childMenus' => function($query) {
            $query->orderBy('title');
        }])->get();

        return $menus;
    }

    public function getLevelAttribute()
    {
        $level = 0;
        $parent = $this->parentMenu;

        while ($parent) {
            $level++;
            $parent = $parent->parentMenu;
        }

        return $level;
    }

    public function getHierarchicalTitleAttribute()
    {
        return str_repeat('>', $this->level) . ' ' . $this->title;
    }

}
