<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = ['title', 'description', 'alias', 'menu_id', 'img'];

    public function products()
    {
        return $this->belongsToMany(Product::class);
    }

    public function getProductsByCategoryId($categoryId)
    {
        return $this->findOrFail($categoryId)->products;
    }

    public function menu()
    {
        return $this->belongsTo(Menu::class);
    }



    public function subcategories()
    {
        return $this->hasMany(Subcategory::class);
    }

    public function menus()
    {
        return $this->belongsToMany(Menu::class, 'category_menu', 'category_id', 'menu_id');
    }

    // public function getImgAttribute(string $value): string
    // {
    //     return '/images/categories/' . $value;
    // }

    public function getForMainPage()
    {
        return $this
            ->whereNotNull('img')
            ->with('menu')
            ->take(8)
            ->get();
    }

    public function getWhereMenu(Menu $menu)
    {
        return $this
            ->whereMenuId($menu->id)
            ->with('menu')
            ->withCount('products')
            ->get();
    }

    public function filters()
    {
        return $this->belongsToMany(Filter::class);
    }

    public function countProducts()
    {
        return $this->products()->count();
    }


    public function calculatePageCount($perPage)
    {
        $totalCount = $this->countProducts();
        return ceil($totalCount / $perPage);
    }


    public function getLinkAttribute()
    {
        return ("/category/".$this->alias);

    }
}
