<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class Brand extends Model
{
    protected $fillable = [
        'title', 'alias', 'image'
    ];

    public function products()
    {
        return $this->hasMany(Product::class);
    }

    public function getForMenuWithCountProducts(Menu $menu)
    {
        return $this
            ->whereIn('brands.id', $menu->products->pluck('brand_id')->unique())
            ->withCount(['products' => function ($query) use ($menu) {
                $query
                    ->join('categories', 'categories.id', '=', 'products.category_id')
                    ->where('categories.menu_id', $menu->id);
            }])
            ->get();
    }

    public function getForCategoryWithCountProducts(Category $category)
    {
        return $this
            ->whereIn('brands.id', $category->products->pluck('brand_id')->unique())
            ->withCount(['products' => function ($query) use ($category) {
                $query->where('category_id', $category->id);
            }])
            ->get();
    }
}
